<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        DB::table('users')->insert(array(
            0 =>
                array('name' => 'Nickolas Ribeiro','email' => 'nickolas.ribeiro@facilconsulta.com', 'password' => bcrypt('12345678'), 'created_at' => now(), 'updated_at' => now()),
        ));
        
        DB::table('cidades')->insert(array(
            0 => array('nome' => 'Paulo Afonso','estado' => 'Bahia', 'created_at' => now(), 'updated_at' => now()),
            1 => array('nome' => 'São Paulo','estado' => 'São Paulo', 'created_at' => now(), 'updated_at' => now()),
        ));

        DB::table('paciente')->insert(array(
            0 => array('nome' => 'Ricardo Nogueira', 'cpf' => '111.111.111-11', 'celular' => '(75) 91111-1111', 'created_at' => now(), 'updated_at' => now()),
            1 => array('nome' => 'Lucinda Souza', 'cpf' => '222.222.222-22', 'celular' => '(75) 92222-2222', 'created_at' => now(), 'updated_at' => now()),
        ));

        DB::table('medico')->insert(array(
            0 => array('nome' => 'Savio Felipe', 'especialidade' => 'Cardiologista', 'cidade_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            1 => array('nome' => 'José Ricardo', 'especialidade' => 'Neurologista', 'cidade_id' => 1, 'created_at' => now(), 'updated_at' => now()),
        ));
    }
}
