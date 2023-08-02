<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Paciente\PacienteService;
use Illuminate\Http\Request;

class PacienteController extends Controller {

    private $pacienteService;

    
    public function __construct(PacienteService $pacienteService)
    {
        $this->pacienteService = $pacienteService;
    }

    public function listPacientesByMedic($id)
    {
        return $this->pacienteService->listPacientesByMedic($id);
    }

    public function store(Request $request)
    {
        return $this->pacienteService->store($request);
    }

    public function update($id, Request $request)
    {
        return $this->pacienteService->update($id, $request);
    }

}