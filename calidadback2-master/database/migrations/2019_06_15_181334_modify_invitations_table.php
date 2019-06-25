<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->string('comment')->nullable()->change();
            $table->string('invitation_start_date')->nullable()->change();
            $table->renameColumn('invitation_start_date', 'invitation_date');
            $table->dropColumn('invitation_end_date');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
