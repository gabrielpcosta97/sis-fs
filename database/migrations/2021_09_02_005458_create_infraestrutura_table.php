<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfraestruturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infraestrutura', function(Blueprint $table){

            $table->id();
            $table->unsignedBigInteger("id_andar");
            $table->string("departamento");
            $table->string("nome_ambiente");
            $table->string('uso_principal');
            $table->integer('ocupacao_maxima');
            $table->float('area');
            $table->string('epi');
            $table->string('insumos_solicitados');
            $table->string('insumos_recebidos');
            $table->string("saidas_ar");
            $table->string('classificacao');
            $table->float('latitude');
            $table->float('longitude');
            $table->foreign('id_andar')->references("id")->on('andar');
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
        Schema::dropIfExists('infraestrutura');
    }
}
