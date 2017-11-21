<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $primaryKey = 'id_livro';

    public $timestamps = false;

    protected $fillable = [
        'id_livro', 'titulo', 'autor', 'colecao', 'materia', 'disponibilidade'
    ];

    public function updateRow(Livro $livro)
    {
        return Livro::newQuery()->where('id_livro', $livro->id_livro)->update($livro->toArray());
    }

    public function livrosDisponiveis() {
        return Livro::newQuery()->where('disponibilidade', 1)->get();
    }

}
