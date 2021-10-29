<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotosVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos_veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('url');            
            $table->unsignedBigInteger('veiculo_id');
            $table->timestamps();

            $table->foreign('veiculo_id')
            ->references('id')
            ->on('veiculos')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fotos_veiculos');
    }
}
