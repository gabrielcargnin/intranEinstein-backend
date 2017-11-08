<?php

namespace App\Http\Controllers;

use App\Livro;
use App\Repositories\LivroRepository;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    /**
     * @var LivroRepository
     */
    private $livroRepository;

    /**
     * LivroController constructor.
     */
    public function __construct(LivroRepository $livroRepository)
    {
        $this->livroRepository = $livroRepository;
    }

    public function list()
    {
        $livros = $this->livroRepository->list();
        return response()->json($livros);
    }

    public function get($id)
    {
        $livro = $this->livroRepository->get($id);
        if ($livro) {
            return response()->json($livro);
        }
        return response()->json(['message' => 'Livro não foi encontrado'], 404);
    }

    public function delete($id)
    {
        if($this->livroRepository->delete($id)) {
            return response()->json(['message' => 'Livro deletado'], 200);
        }
        return response()->json(['message' => 'Livro não foi deletado'], 400);
    }

    public function create(Request $request) {
        if ($this->livroRepository->create(new Livro($request->all()))) {
            return response()->json(['message' => 'Livro registrado'], 201);
        }
        return response()->json(['message' => 'Livro não foi registrado'], 400);
    }

    public function update(Request $request, $id) {
        if (!$this->livroRepository->get($id)) {
            return response()->json(['message' => 'Livro não foi encontrado'], 400);
        }
        if($this->livroRepository->update(new Livro($request->all()))) {
            return response()->json(['message' => 'Livro editado'], 200);
        }
        return response()->json(['message' => 'Livro não foi editado'], 400);
    }

}

