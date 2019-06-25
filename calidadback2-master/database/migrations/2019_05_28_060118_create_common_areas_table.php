<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommonAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('common_areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('available')->default(true);

            $table->unsignedBigInteger('edifice_id');
            $table->foreign('edifice_id')->references('id')->on('edifices');
            
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
        Schema::dropIfExists('common_areas');
    }
}
