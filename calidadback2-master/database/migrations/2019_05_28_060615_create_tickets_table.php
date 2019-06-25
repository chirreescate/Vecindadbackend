<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('resident_id');
            $table->string('message');
            $table->unsignedBigInteger('ticket_status_id');
            $table->unsignedBigInteger('ticket_category_id');

            $table->timestamps();

            $table->foreign('ticket_status_id')->references('id')->on('ticket_states');
            $table->foreign('ticket_category_id')->references('id')->on('ticket_categories');
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
        Schema::dropIfExists('tickets');
    }
}
