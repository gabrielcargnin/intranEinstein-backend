<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmprestimoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emprestimo', function (Blueprint $table) {
            $table->increments('id_emprestimo');
            $table->date('data_emprestimo');
            $table->date('data_devolucao');
            $table->date('data_entregue')->nullable(true);
            $table->boolean('renovacao')->default(false);

            $table->unsignedInteger('id_usuario');
            $table->unsignedInteger('id_livro');

            $table->foreign('id_usuario')->references('id_usuario')->on('users');
            $table->foreign('id_livro')->references('id_livro')->on('livros');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emprestimo');
    }
}
