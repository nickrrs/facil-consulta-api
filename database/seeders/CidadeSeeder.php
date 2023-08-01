<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
