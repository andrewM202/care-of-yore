<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array(
                'role_id'=>1,
                'role_name'=>'Admin',
                'access_level'=>1,
            ),
            array(
                'role_id'=>2,
                'role_name'=>'Supervisor',
                'access_level'=>2,
            ),
            array(
                'role_id'=>3,
                'role_name'=>'Patient',
                'access_level'=>5,
            ),
            array(
                'role_id'=>4,
                'role_name'=>'Doctor',
                'access_level'=>3
            ),
            array(
                'role_id'=>5,
                'role_name'=>'Caregiver',
                'access_level'=>4
            ),
            array(
                'role_id'=>6,
                'role_name'=>'Family Member',
                'access_level'=>6,
            ),
        );
        DB::table('roles')->insert($data);
    }
}
