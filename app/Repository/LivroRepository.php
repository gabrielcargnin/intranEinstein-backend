<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 07/11/2017
 * Time: 00:50
 */

namespace App\Repositories;

use App\Livro;

class LivroRepository
{
    /**
     * @var Livro
     */
    private $livro;

    /**
     * LivroRepository constructor.
     */
    public function __construct(Livro $livro)
    {
        $this->livro = $livro;
    }

    public function list()
    {
        return $this->livro->all();
    }

    public function get($id)
    {
        return $this->livro->find($id);
    }

    public function delete($id)
    {
        $livro = $this->livro->find($id);
        if (!$livro) {
            return false;
        }
        $this->livro->destroy($id);
        return true;
    }

    public function update(Livro $livro)
    {
        $erro = $this->validateUpdate($livro);
        if (strlen($erro) > 0) {
            throw (new \Exception($erro));
        }
        return $this->livro->updateRow($livro);
    }

    public function create(Livro $livro)
    {
        $erro = $this->validate($livro);
        if (strlen($erro) > 0) {
            throw (new \Exception($erro));
        }
        return $livro->save();
    }

    private function validate(Livro $livro)
    {
        $errors = [];
        $erro = "";
        if (!$livro->titulo) {
            array_push($errors, "Você precisa informar um título.");
        }
        if (!$livro->autor) {
            array_push($errors, "Você precisa informar um autor.");
        }
        if (!$livro->colecao) {
            array_push($errors, "Você precisa informar uma coleção.");
        }
        if (!$livro->materia) {
            array_push($errors, "Você precisa informar uma matéria.");
        }
        foreach ($errors as $string) {
            $erro .= $string . "\n";
        }
        return $erro;
    }

    private function validateUpdate(Livro $livro)
    {
        $erro = $this->validate($livro);
        if (!$livro->id_livro) {
            $erro .= "Id não informado";
        }
        return $erro;
    }
}