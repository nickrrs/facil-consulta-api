<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Cidades\CidadeService;
use Illuminate\Http\Request;

class CidadeController extends Controller {

    private $cidadeService;

    
    public function __construct(CidadeService $cidadeService)
    {
        $this->cidadeService = $cidadeService;
    }

    public function index(Request $request)
    {
        return $this->cidadeService->index();
    }

}