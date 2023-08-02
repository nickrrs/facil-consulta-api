<?php

namespace App\Services\Paciente;
use Exception;
use Throwable;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Paciente;
use App\Validators\Paciente\PacienteValidator;
use Illuminate\Support\Facades\Validator;

class PacienteService  {
    private $paciente;
    public function __construct(Paciente $paciente){
        $this->paciente = $paciente;
    }

    public function listPacientesByMedic(int $id){

        try{        
            
            $pacientes = $this->paciente::join('medico_paciente', 'paciente.id', 'paciente_id')->where('medico_paciente.medico_id', $id)->with(['medico'])->get();
            
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