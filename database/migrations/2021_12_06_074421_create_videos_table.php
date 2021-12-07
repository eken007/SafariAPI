<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('creator_id')->nullable();
            $table->string('titre')->nullable();
            $table->string('rubrique')->nullable();
            $table->string('date_de_sortie')->nullable();
            $table->string('duree')->nullable();
            $table->string('qualite')->nullable();
            $table->longText('description')->nullable();
            $table->string('age')->nullable();
            $table->string('video')->nullable();
            $table->string('image')->nullable();
            $table->string('pub')->nullable();
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
        Schema::dropIfExists('videos');
    }
}
