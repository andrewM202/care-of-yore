<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('"first-name"', 'first_name');
            $table->renameColumn('"last-name"', 'last_name');
            $table->renameColumn('"date-of-birth"', 'date_of_birth');
            $table->renameColumn('"family-code"', 'family_code');
            $table->renameColumn('"emergency-contact"', 'emergency_contact');
            $table->renameColumn('"emergency-contact-relation"', 'emergency_contact_relation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('first_name', 'first-name');
            $table->renameColumn('last_name', 'last-name');
            $table->renameColumn('date_of_birth', 'date-of-birth');
            $table->renameColumn('family_code', 'family-code');
            $table->renameColumn('emergency_contact', 'emergency-contact');
            $table->renameColumn('emergency_contact_relation', 'emergency-contact-relation');
        });
    }
}
