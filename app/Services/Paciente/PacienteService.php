<?php

namespace App\Services\Paciente;
use Exception;
use Throwable;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Paciente;
use App\Models\Medico;
use App\Validators\Paciente\PacienteValidator;
use Illuminate\Support\Facades\Validator;

class PacienteService  {
    private $paciente;
    private $medico;
    public function __construct(Paciente $paciente, Medico $medico){
        $this->paciente = $paciente;
        $this->medico = $medico;
    }

    public function listPacientesByMedic(int $id){

        try{       

            //Validate medic register
            $medico = $this->medico->find($id);
            if(!isset($medico)) return response()->json(["error" => "Medico com ID não cadastrado."], 422);
            
            $pacientes = $this->paciente::join('medico_paciente', 'paciente.id', 'paciente_id')->where('medico_paciente.medico_id', $id)->get();
            
            return $pacientes ? response()->json($pacientes, 200) : [];

        }  catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        } catch (Throwable $t) {
            return response()->json([
                'error' => $t->getMessage()
            ], 500);
        }

       
    }

    public function store(Request $request){
        $validator = Validator::make(
            $request->all(),
            PacienteValidator::NEW_PACKAGE_RULE,
            PacienteValidator::ERROR_MESSAGES
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try{
            $pacientePayload = $request->all();

            $paciente = $this->paciente->create($pacientePayload);
            $paciente->save();
    
            return response()->json($paciente, 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        } catch (Throwable $t) {
            return response()->json([
                'error' => $t->getMessage()
            ], 500);
        }
    }

    public function update(int $id, Request $request){
        $validator = Validator::make(
            $request->all(),
            PacienteValidator::UPDATE_PACKAGE_RULE,
            PacienteValidator::ERROR_MESSAGES
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            
            $paciente = $this->paciente->find($id);
            if(!isset($paciente)) return response()->json(["error" => "Paciente com ID não cadastrado."], 422);

            isset($request->nome) ? $paciente->nome = $request->nome : $paciente->nome;
            isset($request->cpf) ? $paciente->cpf = $request->cpf : $request->cpf;
            isset($request->telefone) ? $paciente->telefone = $request->telefone : $request->telefone;

            $paciente->save();

            return $paciente ? response()->json($paciente, 200) : [];

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        } catch (Throwable $t) {
            return response()->json([
                'error' => $t->getMessage()
            ], 500);
        }
    }
}