<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimuladosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simulados', function (Blueprint $table) {
            $table->increments('id_simulado');
            $table->date('data_inicio_inscricao');
            $table->date('data_fim_inscricao');
            $table->enum('modelo', ['UFSC', 'ENEM', 'UDESC']);
            $table->jsonb('datas_aplicacao');
            $table->jsonb('horarios_apli/cacao');
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
        Schema::dropIfExists('simulados');
    }
}