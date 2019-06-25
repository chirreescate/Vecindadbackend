<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('resident_id');
            $table->BigInteger('event_id')->nullable()->unsigned();
            $table->string('name');
            $table->string('email');
            $table->string('dni');
            $table->string('comment');
            $table->dateTime('invitation_start_date');
            $table->dateTime('invitation_end_date');
            $table->boolean('check')->nullable();
            $table->boolean('regular_visitor');
            $table->timestamps();

            $table->foreign('resident_id')->references('id')->on('residents');
            $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitations');
    }
}
