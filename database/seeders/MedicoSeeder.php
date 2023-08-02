<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medico')->insert(array(
            0 => array('nome' => 'Savio Felipe', 'especialidade' => 'Cardiologista', 'cidade_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            1 => array('nome' => 'José Ricardo', 'especialidade' => 'Neurologista', 'cidade_id' => 1, 'created_at' => now(), 'updated_at' => now()),
        ));
    }
}
