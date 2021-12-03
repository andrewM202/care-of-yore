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
            ),
            array(
                'role_id'=>2,
                'role_name'=>'Supervisor',
            ),
            array(
                'role_id'=>3,
                'role_name'=>'Patient',
            ),
            array(
                'role_id'=>4,
                'role_name'=>'Doctor',
            ),
            array(
                'role_id'=>5,
                'role_name'=>'Caregiver',
            ),
            array(
                'role_id'=>6,
                'role_name'=>'Family Member',
            ),
        );
        DB::table('roles')->insert($data);
    }
}
