<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicoPacienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medico_paciente', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('medico_id')->unsigned();
            $table->foreign('medico_id')->references('id')->on('medico')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('paciente_id')->unsigned();
            $table->foreign('paciente_id')->references('id')->on('paciente')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medico_paciente');
    }
}
