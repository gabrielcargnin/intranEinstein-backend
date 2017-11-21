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
     * @var Livro
     */
    private $livro;

    /**
     * EmprestimoRepository constructor.
     */
    public function __construct(Livro $livro)
    {
        $this->emprestimoTable = DB::table('emprestimo_livro');
        $this->livro = $livro;
    }

    public function emprestimo($ids)
    {
        if (array_key_exists("id_usuario", $ids) && array_key_exists("id_livro", $ids)) {
            DB::beginTransaction();
            $livro = Livro::query()->find($ids['id_livro']);
            if ($livro) {
                $livro->disponibilidade = 0;
                if ($this->livro->updateRow($livro)) {
                    $date = strtotime("+15 day");
                    $data_devolucao = date('Y-m-d', $date);
                    $data_emprestimo = date('Y-m-d');
                    $this->emprestimoTable->insert(
                        [
                            'id_usuario'         => $ids['id_usuario'],
                            'id_livro'           => $ids['id_livro'],
                            'data_devolucao'     => $data_devolucao,
                            'data_emprestimo' => $data_emprestimo
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
            'livros.autor', 'livros.titulo', 'emprestimo_livro.data_devolucao', 'emprestimo_livro.data_emprestimo'
            )
            ->get();
        return $livros;
    }

    public function devolve($id_emprestimo) {
        if ($id_emprestimo) {
            DB::beginTransaction();
            $hoje = date('Y-m-d');
            $this->emprestimoTable->where('id_emprestimo', $id_emprestimo)
                ->update([
                    'data_entregue' => $hoje
                ]);
            try {
                DB::table('livros')
                    ->whereRaw('id_livro = (SELECT id_livro FROM emprestimo_livro WHERE id_emprestimo = ?)', [$id_emprestimo])
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