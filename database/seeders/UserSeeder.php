<?php

namespace Database\Seeders;

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
        DB::table('users')->insert(array(
            0 =>
                array('name' => 'Nickolas Ribeiro','email' => 'nickolas.ribeiro@facilconsulta.com', 'password' => bcrypt('12345678'), 'created_at' => now(), 'updated_at' => now()),
        ));
    }
}
