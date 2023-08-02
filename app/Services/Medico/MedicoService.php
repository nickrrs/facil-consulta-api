<?php

namespace App\Services\Medico;
use Exception;
use Throwable;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Cidades;
use App\Models\MedicoPaciente;
use App\Validators\Medico\MedicoValidator;
use App\Validators\MedicoPaciente\MedicoPacienteValidator;
use Illuminate\Support\Facades\Validator;

class MedicoService  {
    private $medico;
    private $medicoPaciente;
    private $pacienteModel;
    private $medicoModel;
    private $cidadeModel;

    public function __construct(Medico $medico, MedicoPaciente $medicoPaciente, Paciente $pacienteModel, Medico $medicoModel, Cidades $cidadeModel){
        $this->medico = $medico;
        $this->medicoPaciente = $medicoPaciente;
        $this->pacienteModel = $pacienteModel;
        $this->medicoModel = $medicoModel;
        $this->cidadeModel = $cidadeModel;
    }

    public function index(){
        try{
            $medicos = $this->medico::all();
            return response()->json($medicos, 200);

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

    public function listMedicsByCity(int $id){

        try{        
            //Validate city register
            $cidade = $this->cidadeModel->find($id);
            if(!isset($cidade)) return response()->json(["error" => "Cidade com ID não cadastrado."], 422);

            $medicos = $this->medico::where('cidade_id', $id)->with('cidade')->get();

            return $medicos ? response()->json($medicos, 200) : [];

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
            MedicoValidator::NEW_PACKAGE_RULE,
            MedicoValidator::ERROR_MESSAGES
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try{
            $medicoPayload = $request->all();

            $medico = $this->medico->create($medicoPayload);
            $medico->save();
    
            return response()->json($medico, 200);
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

    public function associatePacient(int $id, Request $request){
                
        $validator = Validator::make(
            $request->all(),
            MedicoPacienteValidator::NEW_PACKAGE_RULE,
            MedicoPacienteValidator::ERROR_MESSAGES
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try{
            $medicoPacientePayload = $request->all();

            //Validate medic register
            $medico = $this->medicoModel->find($medicoPacientePayload['medico_id']);
            if(!isset($medico)) return response()->json(["error" => "Médico com ID não cadastrado."], 422); 
            
            //Validate pacient register
            $paciente = $this->pacienteModel->find($medicoPacientePayload['paciente_id']);     
            if(!isset($paciente)) return response()->json(["error" => "Paciente com ID não cadastrado."], 422); 

            isset($medicoPacientePayload['medico_id']) ? $medicoPacientePayload['medico_id'] : $medicoPacientePayload['medico_id'] = $id;

            $medicoPaciente = $this->medicoPaciente->create($medicoPacientePayload);
            if($medicoPaciente->save()){
                return response()->json([
                    "medico" => $medico,
                    "paciente" => $paciente
                ], 200);
            }
            
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