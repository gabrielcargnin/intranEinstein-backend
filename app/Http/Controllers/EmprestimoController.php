<?php

namespace App\Http\Controllers;

use App\Repositories\EmprestimoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class EmprestimoController extends Controller
{
    /**
     * @var EmprestimoRepository
     */
    private $emprestimoRepository;

    /**
     * EmprestimoController constructor.
     */
    public function __construct(EmprestimoRepository $emprestimoRepository)
    {
        $this->emprestimoRepository = $emprestimoRepository;
    }

    public function emprestimo(Request $request)
    {
        if ($this->emprestimoRepository->emprestimo($request->all())) {
            return response()->json(['message' => 'Empréstimo realizado'], 200);
        }
        return response()->json(['message' => 'Empréstimo não foi realizado'], 400);
    }

    public function getEmprestimosById()
    {
        if (Input::get('idUsuario')) {
            $livros = $this->emprestimoRepository->getEmprestimosById(Input::get('idUsuario'));
            return response()->json($livros, 200);
        }
        return response()->json(['message' => 'ID usuário não passado'], 400);
    }

    public function devolve()
    {
        if ($this->emprestimoRepository->devolve(Input::get('idEmprestimoLivro'))) {
            return response()->json(['message' => 'Livro devolvido'], 200);
        }
        return response()->json(['message' => 'Livro não foi devolvido'], 400);
    }
}
