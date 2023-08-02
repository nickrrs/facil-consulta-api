<?php

use Illuminate\Routing\Router;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controllers
use \App\Http\Controllers\API\CidadeController;
use \App\Http\Controllers\API\PacienteController;
use \App\Http\Controllers\API\MedicoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$router = app(Router::class);
//Public Routes
    //Cidades
    $router->namespace('Api\Cidades')->group(function () use ($router){
        $router
            ->prefix('cidades')
            ->name('cidades.')
            ->group(function() use ($router){
                $router->get('/', [CidadeController::class, 'index']);
                $router->get('/{id}/medicos', [MedicoController::class, 'listMedicsByCity']);
            });
    });

//Auth Routes
    //Paciente
        $router->namespace('Api\Pacientes')->group(function () use ($router){
            $router
                ->prefix('pacientes')
                ->name('pacientes.')
                ->group(function() use ($router){
                    $router->post('/', [PacienteController::class, 'store']);
                    $router->put('/{id}', [PacienteController::class, 'update']);
                });
        });
    
    //Medico
        $router->namespace('Api\Medicos')->group(function () use ($router){
            //Plans Routes
            $router
                ->prefix('medicos')
                ->name('medicos.')
                ->group(function() use ($router){
                    $router->get('/', [MedicoController::class, 'index']);
                    $router->get('/{id}/pacientes', [PacienteController::class, 'listPacientesByMedic']);
                    $router->post('/', [MedicoController::class, 'store']);
                    $router->post('/{id}/pacientes', [MedicoController::class, 'associatePacient']);
                });
        });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
