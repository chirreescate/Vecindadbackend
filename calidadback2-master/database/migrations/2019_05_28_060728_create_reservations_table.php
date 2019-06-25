<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('resident_id');
            $table->unsignedBigInteger('common_area_id');
            $table->dateTime('reservation_start_date');
            $table->dateTime('reservation_end_date');
            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->foreign('common_area_id')->references('id')->on('common_areas');
            $table->foreign('resident_id')->references('id')->on('residents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
