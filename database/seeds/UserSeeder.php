<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert(
            [
                'first_name' => 'Suyesh',
                'last_name' => 'Amatya',
                'pnr' => '198210151232',
                'roles' => 'ADMIN_ROLE,USER_ROLE'
            ],
            [
                'first_name' => 'Roxana',
                'last_name' => 'Merinõ Martinez',
                'pnr' => '196508029482',
                'roles' => 'ADMIN_ROLE,USER_ROLE'
            ],
            [
                'first_name' => 'Sadaf',
                'last_name' => 'Sakina Hassan',
                'pnr' => '198608070606',
                'roles' => 'ADMIN_ROLE,USER_ROLE'
            ]
        );
    }
}
