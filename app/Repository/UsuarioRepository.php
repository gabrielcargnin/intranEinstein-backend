<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 07/11/2017
 * Time: 00:19
 */

namespace App\Repositories;

use App\Usuario;

class UsuarioRepository
{
    /**
     * @var Usuario
     */
    private $usuario;

    /**
     * UsuarioRepository constructor.
     */
    public function __construct(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    public function list()
    {
        return $this->usuario->all();
    }

    public function get($id)
    {
        return $this->usuario->find($id);
    }

    public function delete($id)
    {
        $livro = $this->usuario->find($id);
        if (!$livro) {
            return false;
        }
        $this->usuario->destroy($id);
        return true;
    }

    public function update(Usuario $usuario)
    {
        $erro = $this->validateUpdate($usuario);
        if (strlen($erro) > 0) {
            throw (new \Exception($erro));
        }
        return $this->usuario->updateRow($usuario);
    }

    public function create(Usuario $usuario)
    {
        $erro = $this->validate($usuario);
        if (strlen($erro) > 0) {
            throw (new \Exception($erro));
        }
        return $usuario->save();
    }

    private function validate(Usuario $usuario)
    {
        $errors = [];
        $erro = "";
        if (!$usuario->cpf) {
            array_push($errors, "Você precisa informar um cpf.");
        }
        if (!$usuario->cpf && strlen(!$usuario->cpf) < 12 ) {
            array_push($errors, "Você precisa informar um cpf com 9 dígitos.");
        }
        if (!$usuario->email) {
            array_push($errors, "Você precisa informar um email.");
        }
        foreach ($errors as $string) {
            $erro .= $string . "\n";
        }
        return $erro;
    }

    private function validateUpdate(Usuario $usuario)
    {
        $erro = $this->validate($usuario);
        if (!$usuario->id_usuario) {
            $erro .= "Id não informado";
        }
        return $erro;
    }
}