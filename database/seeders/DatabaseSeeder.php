<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cidades')->insert(array(
            0 =>
                array('nome' => 'Paulo Afonso','estado' => 'Bahia', 'created_at' => now(), 'updated_at' => now()),
            1 => array('nome' => 'São Paulo','estado' => 'São Paulo', 'created_at' => now(), 'updated_at' => now()),
        ));
    }
}
