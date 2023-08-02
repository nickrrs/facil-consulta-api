<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Medico\MedicoService;
use Illuminate\Http\Request;

class MedicoController extends Controller {

    private $medicoService;

    
    public function __construct(MedicoService $medicoService)
    {
        $this->medicoService = $medicoService;
    }

    public function index()
    {
        return $this->medicoService->index();
    }

    public function listMedicsByCity($id)
    {
        return $this->medicoService->listMedicsByCity($id);
    }

    public function store(Request $request)
    {
        return $this->medicoService->store($request);
    }

    public function associatePacient($id, Request $request)
    {
        return $this->medicoService->associatePacient($id, $request);
    }

}