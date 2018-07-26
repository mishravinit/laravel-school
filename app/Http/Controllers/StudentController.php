<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student as Model;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Services\MessageService;

use App\Http\Resources\Student as StudentResource;
use App\Exceptions;


class StudentController extends Controller
{
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function index()
    {
        try {
            return StudentService::getAll();
        } catch (\Exception $e) {
            return $this->messageService->getFailMessageByServer($e);
        }
    }

    public function show($id)
    {
        try {
            $model = StudentService::getById($id);
        } catch (\Exception $e) {
            return $this->messageService->getFailMessageByServer($e);
        }
        return $model;
    }

    public function login(Request $request)
    {
        $credentials = StudentService::getCredentials($request);
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->messageService->getCustomFailMessageByClient('invalid_email_or_password');
            }
        } catch (JWTException $e) {
            return $this->messageService->getCustomFailMessageByServer('fail_to_create_token');
        }
        return StudentService::getTokenSuccessMessage($token);
    }

}


class StudentService
{
    public static function getCredentials($request)
    {
        return $request->only('email', 'password');
    }

    public static function getById($id)
    {
        return Model::findOrFail($id)
            ->with('role')
            ->get();
    }

    public static function getAll()
    {
        return Model::with('role')
            ->get();
    }

    public static function getTokenSuccessMessage($message)
    {
        return response()->json([
            'error_code' => '0000',
            'error_message' => 'get_token_success',
            'token' => $message
        ]);
    }
}