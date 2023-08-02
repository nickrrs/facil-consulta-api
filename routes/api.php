<?php

use Illuminate\Routing\Router;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controllers
use \App\Http\Controllers\API\CidadeController;
use \App\Http\Controllers\API\PacienteController;

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
            });
    });

//Auth Routes
    //Paciente
        $router->namespace('Api\Pacientes')->group(function () use ($router){
            $router
                ->prefix('pacientes')
                ->name('pacientes.')
                ->group(function() use ($router){
                    $router->get('/', [PacienteController::class, 'listPacientesByMedic']);
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
                    $router->get('/{id}/pacientes', [PacienteController::class, 'listPacientesByMedic']);
                });
        });


Route::get('/cidades', [CidadeController::class, 'index'])->name('cidades.index');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
