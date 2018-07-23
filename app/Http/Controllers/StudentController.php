<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student as Model;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Http\Resources\Student as StudentResource;
use App\Exceptions;

class StudentController extends Controller
{
    public function __construct(Model $model)
    {

    }

    public function index()
    {
        try {
            return StudentService::getAll();
        } catch (\Exception $e) {
            return StudentService::getFailMessageByServer($e);
        }
    }

    public function show($id)
    {
        try {
            $model = StudentService::getById($id);
        } catch (\Exception $e) {
            return StudentService::getFailMessageByServer($e);
        }
        return $model;
    }

//    public function store(Request $request)
//    {
//        $model = Model::create($request->all());
//        return response()->json($model, 201);
//    }

//    public function update(Request $request, Model $model)
//    {
//        $model->update($request->all());
//        return response()->json($model, 200);
//    }

//    public function delete(Article $article)
//    {
//        $article->delete();
//        return response()->json(null, 204);
//    }


    public function login(Request $request)
    {
        $credentials = StudentService::getCredentials($request);
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return StudentService::getCustomFailMessageByClient('invalid_email_or_password');
            }
        } catch (JWTException $e) {
            return StudentService::getCustomFailMessageByServer('fail_to_create_token');
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

    public static function getFailMessageByServer($e)
    {
        return response()->json([
            'error_code' => '0002',
            'error_message' => 'general_error',
            'error_message_extra' => $e->getMessage()
        ]);
    }

    public static function getCustomFailMessageByServer($message)
    {
        return response()->json([
            'error_code' => '0002',
            'error_message' => $message
        ]);
    }

    public static function getCustomFailMessageByClient($message)
    {
        return response()->json([
            'error_code' => '0001',
            'error_message' => $message
        ]);
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