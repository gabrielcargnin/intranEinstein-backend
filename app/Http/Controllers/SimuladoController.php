<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSimuladoRequest;
use App\Http\Requests\UpdateSimuladoRequest;
use App\Simulado;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class SimuladoController extends Controller
{
    /**
     * @var Simulado
     */
    private $simulado;


    /**
     * SimuladoController constructor.
     */
    public function __construct(Simulado $simulado)
    {
        $this->simulado = $simulado;
    }

    public function list()
    {
        $simulados = $this->simulado->all();
        return response()->json($simulados);
    }

    public function get($id)
    {
        $simulado = $this->simulado::query()->find($id);
        if ($simulado) {
            return response()->json($simulado);
        }
        return response()->json(['message' => 'Simulado não foi encontrado'], 404);
    }

    public function delete($id)
    {
        if ($this->simulado->destroy($id)) {
            return response()->json(['message' => 'Simulado deletado'], 200);
        }
        return response()->json(['message' => 'Simulado não foi deletado'], 400);
    }

    public function create(StoreSimuladoRequest $request)
    {
        if ($this->simulado::query()->insert(
            [
                'data_inicio_inscricao' => $request['data_inicio_inscricao'],
                'data_fim_inscricao' => $request['data_fim_inscricao'],
                'horarios_aplicacao' => json_encode($request['horarios_aplicacao']),
                'datas_aplicacao' => json_encode($request['datas_aplicacao']),
                'modelo' => $request['modelo']
            ]
        )) {
            return response()->json(['message' => 'Simulado registrado'], 201);
        }
        return response()->json(['message' => 'Simulado não foi registrado.'], 400);
    }

    public function update(UpdateSimuladoRequest $request, $id)
    {
        if (!$this->simulado::query()->find($id)) {
            return response()->json(['message' => 'Simulado não foi encontrado'], 400);
        }
        if ($this->simulado->updateRow(new Simulado($request->all()))) {
            return response()->json(['message' => 'Simulado editado'], 200);
        }
        return response()->json(['message' => 'Simulado não foi editado'], 400);
    }

}

