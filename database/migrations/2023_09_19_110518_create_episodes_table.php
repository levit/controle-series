<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            //PK
            $table->id();
            
            //Campos
            $table->unsignedTinyInteger('number');
            $table->unsignedBigInteger('season_id');
            
            //Chaves Estrangerias
            $table->foreign('season_id')->references('id')->on('seasons')->cascadeOnDelete();
            //$table->foreignId('season_id')->constrained('seasons','id');
            
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodes');
    }
}
