<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFeeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feed', function (Blueprint $table) {
            $table->string('breakfast')->nullable()->change();
            $table->string('lunch')->nullable()->change();
            $table->string('dinner')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feed', function (Blueprint $table) {
            $table->boolean('breakfast')->change();
            $table->boolean('lunch')->change();
            $table->boolean('dinner')->change();
        });
    }
}
