<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paciente')->insert(array(
            0 =>
                array('nome' => 'Ricardo Nogueira', 'cpf' => '111.111.111-11', 'celular' => '(75) 91111-1111', 'created_at' => now(), 'updated_at' => now()),
            1 => array('nome' => 'Lucinda Souza', 'cpf' => '222.222.222-22', 'celular' => '(75) 92222-2222', 'created_at' => now(), 'updated_at' => now()),
        ));
    }
}
