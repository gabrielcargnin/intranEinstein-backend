<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Simulado extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_simulado', 'data_inicio_inscricao', 'data_fim_inscricao', 'modelo', 'datas_aplicacao', 'horarios_aplicacao'
    ];

    protected $primaryKey = 'id_simulado';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function updateRow(Simulado $simulado)
    {
        return User::newQuery()->where('id_simulado', $simulado->id_usuario)->update($simulado->toArray());
    }
}
