<?php

namespace App\Http\Controllers;

use App\Services\StudentService;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Services\MessageService;

use App\Http\Resources\Student as StudentResource;
use App\Exceptions;


class StudentController extends Controller
{

    public function index()
    {
        try {
            return StudentService::getAll();
        } catch (\Exception $e) {
            return MessageService::getFailMessageByServer($e);
        }
    }

    public function show($id)
    {
        try {
            $model = StudentService::getById($id);
        } catch (\Exception $e) {
            return MessageService::getFailMessageByServer($e);
        }
        return $model;
    }

    public function login(Request $request)
    {
        $credentials = StudentService::getCredentials($request);
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return MessageService::getCustomFailMessageByClient('invalid_email_or_password');
            }
        } catch (JWTException $e) {
            return MessageService::getCustomFailMessageByServer('fail_to_create_token');
        }
        return StudentService::getTokenSuccessMessage($token);
    }

}


