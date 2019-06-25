<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCascadeDeletes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dropForeign('residents_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign('tickets_resident_id_foreign');
            $table->foreign('resident_id')->references('id')->on('residents')->onDelete('cascade');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign('reservations_resident_id_foreign');
            $table->foreign('resident_id')->references('id')->on('residents')->onDelete('cascade');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign('events_reservation_id_foreign');
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
        });

        Schema::table('invitations', function (Blueprint $table) {
            $table->dropForeign('invitations_event_id_foreign');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');

            $table->dropForeign('invitations_resident_id_foreign');
            $table->foreign('resident_id')->references('id')->on('residents')->onDelete('cascade');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->dropForeign('comments_ticket_id_foreign');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dropForeign('residents_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign('tickets_resident_id_foreign');
            $table->foreign('resident_id')->references('id')->on('residents');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign('reservations_resident_id_foreign');
            $table->foreign('resident_id')->references('id')->on('residents');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign('events_reservation_id_foreign');
            $table->foreign('reservation_id')->references('id')->on('reservations');
        });

        Schema::table('invitations', function (Blueprint $table) {
            $table->dropForeign('invitations_event_id_foreign');
            $table->foreign('event_id')->references('id')->on('events');

            $table->dropForeign('invitations_resident_id_foreign');
            $table->foreign('resident_id')->references('id')->on('residents');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users');

            $table->dropForeign('comments_ticket_id_foreign');
            $table->foreign('ticket_id')->references('id')->on('tickets');
        });
    }
}
