<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfissionalEspecialidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profissional_especialidades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profissional_id')->unsigned();
            $table->unsignedBigInteger('especialidade_id')->unsigned();
            $table->foreign('profissional_id')->references('id')->on('profissionais')->onDelete('cascade');
            $table->foreign('especialidade_id')->references('id')->on('especialidades');
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
        Schema::dropIfExists('profissional_especialidades');
    }
}
