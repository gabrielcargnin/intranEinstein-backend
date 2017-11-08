<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $primaryKey = 'id_usuario';

    public $timestamps = false;

    protected $fillable = [
        'id_usuario', 'cpf', 'email', 'ultimo_acesso'
    ];

    public function updateRow(Usuario $usuario)
    {
        return Usuario::newQuery()->where('id_usuario', $usuario->id_usuario)->update($usuario->toArray());
    }

}
