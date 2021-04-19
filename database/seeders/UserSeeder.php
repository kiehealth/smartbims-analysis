<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        DB::table('users')->insert([
            [
                'name' => 'Suyesh Amatya',
                'email' => 'hisuyesh@hotmail.com',
                'password' => Hash::make('11111111'),
                'ssn' => '198210151232',
                'roles' => 'ADMIN_ROLE,USER_ROLE'
            ],
            [
                'name' => 'Roxana Merinõ Martinez',
                'email' => 'roxana.martinez@ki.se',
                'password' => Hash::make('11111111'),
                'ssn' => '196508029482',
                'roles' => 'ADMIN_ROLE,USER_ROLE'
            ],
            [
                'name' => 'Sadaf Sakina Hassan',
                'email' => 'sadaf.hassan@ki.se',
                'password' => Hash::make('11111111'),
                'ssn' => '198608070606',
                'roles' => 'ADMIN_ROLE,USER_ROLE'
            ]
        ]);
    }
}
