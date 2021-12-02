<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->smallInteger('role');
            $table->string('first-name');
            $table->string('last-name');
            $table->string('phone', 10)->unique();
            $table->date('date-of-birth');
            $table->string('family-code', 6);
            $table->string('emergency-contact');
            $table->string('emergency-contact-relation');
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
