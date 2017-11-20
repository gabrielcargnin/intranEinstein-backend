<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLivroRequest;
use App\Http\Requests\UpdateLivroRequest;
use App\Livro;

class LivroController extends Controller
{
    /**
     * @var Livro
     */
    private $livro;


    /**
     * LivroController constructor.
     */
    public function __construct(Livro $livro)
    {
        $this->livro = $livro;
    }

    public function list()
    {
        $livros = $this->livro->all();
        return response()->json($livros);
    }

    public function getLivrosDisponiveis() {

    }

    public function get($id)
    {
        $livro = $this->livro::query()->find($id);
        if ($livro) {
            return response()->json($livro);
        }
        return response()->json(['message' => 'Livro não foi encontrado'], 404);
    }

    public function delete($id)
    {
        if ($this->livro->destroy($id)) {
            return response()->json(['message' => 'Livro deletado'], 200);
        }
        return response()->json(['message' => 'Livro não foi deletado'], 400);
    }

    public function create(StoreLivroRequest $request)
    {
        if ($this->livro->fill($request->all())->save()) {
            return response()->json(['message' => 'Livro registrado'], 201);
        }
        return response()->json(['message' => 'Livro não foi registrado.'], 400);
    }

    public function update(UpdateLivroRequest $request, $id)
    {
        if (!$this->livro->find($id)) {
            return response()->json(['message' => 'Livro não foi encontrado'], 400);
        }
        if ($this->livro->updateRow(new Livro($request->all()))) {
            return response()->json(['message' => 'Livro editado'], 200);
        }
        return response()->json(['message' => 'Livro não foi editado'], 400);
    }

}

