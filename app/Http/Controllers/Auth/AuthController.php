<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use App\Validators\Auth\RegisterValidator;

class AuthController extends Controller
{
    public function sendResponse($data, $message, $status = 200) 
    {
        $response = [
            'data' => $data,
            'message' => $message
        ];

        return response()->json($response, $status);
    }

    public function sendError($errorData, $message, $status = 500)
    {
        $response = [];
        $response['message'] = $message;
        if (!empty($errorData)) {
            $response['data'] = $errorData;
        }

        return response()->json($response, $status);
    }

    public function register(Request $request) 
    {

        $validator = Validator::make(
            $request->all(),
            RegisterValidator::NEW_PACKAGE_RULE,
            RegisterValidator::ERROR_MESSAGES
        );

        if($validator->fails()){
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }

        $request['password'] = bcrypt($request['password']); // use bcrypt to hash the passwords
        $user = User::create($request->all()); // eloquent creation of data

        $success['user'] = $user;

        return $this->sendResponse($success, 'Usuário criado com sucesso.', 200);

    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');

        $validator = Validator::make($input, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors(), 'Erro na validação do login.', 422);
        }

        try {
            // this authenticates the user details with the database and generates a token
            if (! $token = JWTAuth::attempt($input)) {
                return $this->sendError([], "Credenciais inválidas.", 400);
            }
        } catch (JWTException $e) {
            return $this->sendError([], $e->getMessage(), 500);
        }

        $success = [
            'token' => $token,
        ];
        return $this->sendResponse($success, 'Logado com sucesso !', 200);
    }

    public function getUser() 
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return $this->sendError([], "Usuário não encontrado", 403);
            } 
        } catch (JWTException $e) {
            return $this->sendError([], $e->getMessage(), 500);
        }

        return $this->sendResponse($user, "Dados de usuários coletados com sucesso.", 200);
    }
}