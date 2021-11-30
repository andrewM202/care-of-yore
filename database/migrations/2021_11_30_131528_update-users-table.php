<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->smallint('role');
            $table->varchar('first-name');
            $table->varchar('last-name');
            $table->char('phone', 10)->unique();
            $table->date('date-of-birth');
            $table->char('family-code', 6);
            $table->varchar('emergency-contact');
            $table->varchar('emergency-contact-relation');
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
