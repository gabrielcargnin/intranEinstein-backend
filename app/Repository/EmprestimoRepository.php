<?php

namespace App\Repositories;

use App\Http\Controllers\LivroController;
use Illuminate\Support\Facades\DB;
use App\Livro;

class EmprestimoRepository
{
    /**
     * @var \App\Repositories\LivroRepository
     */
    private $emprestimoTable;

    /**
     * EmprestimoRepository constructor.
     */
    public function __construct()
    {
        $this->emprestimoTable = DB::table('emprestimo_livro');
    }

    public function emprestimo($ids)
    {
        if (array_key_exists("id_usuario", $ids) && array_key_exists("id_livro", $ids)) {
            DB::beginTransaction();
            $livro = Livro::query()->find($ids['id_livro']);
            if ($livro) {
                $livro->disponibilidade = 0;
                if (Livro::query()->update($livro)) {
                    $date = strtotime("+15 day");
                    $data_devolucao = date('Y-m-d', $date);
                    $this->emprestimoTable->insert(
                        [
                            'id_usuario'         => $ids['id_usuario'],
                            'id_livro'           => $ids['id_livro'],
                            'data_devolucao'     => $data_devolucao
                        ]
                    );
                    DB::commit();
                    return true;
                }
            }
            DB::rollBack();
        }
        return false;
    }

    public function getEmprestimosById($id_usuario) {
        $livros = $this->emprestimoTable
            ->where([
                ['id_usuario', '=', $id_usuario],
                ['data_entregue', '=', NULL]
            ])
            ->join('livros', 'livros.id_livro', '=', 'emprestimo_livro.id_livro')
            ->select(
            'livros.autor', 'livros.titulo', 'emprestimo_livro.data_devolucao'
            )
            ->get();
        return $livros;
    }

    public function devolve($id_emprestimo_livro) {
        if ($id_emprestimo_livro) {
            DB::beginTransaction();
            $hoje = date('Y-m-d');
            $this->emprestimoTable->where('id_emprestimo_livro', $id_emprestimo_livro)
                ->update([
                    'data_entregue' => $hoje
                ]);
            try {
                DB::table('livros')
                    ->whereRaw('id_livro = (SELECT id_livro FROM emprestimo_livro WHERE id_emprestimo_livro = ?)', [$id_emprestimo_livro])
                    ->update([
                        'disponibilidade' => 1
                    ]);
            }
            catch (\Exception $e) {
                DB::rollBack();
                return false;
            }
        }
        DB::commit();
        return true;
    }
}