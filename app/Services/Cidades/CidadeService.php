<?php

namespace App\Services\Cidades;
use Exception;
use Throwable;
use App\Models\Cidades;

class CidadeService  {
    private $cidade;
    public function __construct(Cidades $cidade){
        $this->cidade = $cidade;
    }

    public function index(){
        try{
            $cidades = $this->cidade::all();
            return response()->json($cidades, 200);

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
}