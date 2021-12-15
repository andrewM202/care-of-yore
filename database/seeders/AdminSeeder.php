<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'admin123@gmail.com',
            // 'password' => Hash::make('password'),
            'password' => '$2y$10$Vf4BzRm7HximkG/1Pwh9DOZgr3GBilaTNg45FjjNcs2wPIi/A2wle',
            'remember_token' => null,
            'email_verified_at' => null,
            'created_at' => '2021-12-11 00:56:19',
            'updated_at' => '2021-12-11 00:56:56',
            'role' => 1,
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'phone' => '123-544-1245',
            'date_of_birth' => '2002-10-17',
            'family_code' => null,
            'emergency_contact' => null,
            'emergency_contact_relation' => null,
            'approval' => 1,
            'group' => null,
            'admission_date' => null,
            'salary' => 0
        ]);
    }
}
