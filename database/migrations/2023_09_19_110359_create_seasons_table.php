<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            //PK
            $table->id();
            
            //Campos
            $table->unsignedTinyInteger('number');
            $table->unsignedBigInteger('series_id');
            
            //Chaves Estrangerias
            $table->foreign('series_id')->references('id')->on('series')->cascadeOnDelete();
            //$table->foreignId('series_id')->constrained('series','id');
            
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
        Schema::dropIfExists('seasons');
    }
}
