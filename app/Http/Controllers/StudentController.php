<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Student as Model;
use App\Http\Resources\Student as StudentResource;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class StudentController extends Controller
{
    public function __construct(Model $model)
    {

    }

    public function index()
    {
        return Model::find(1)
            ->leftJoin('roles', 'students.role', '=', 'roles.id')
            ->select('*')
            ->get();
    }

    public function store(Request $request)
    {
        $model = Model::create($request->all());
        return response()->json($model, 201);
    }

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

    public function show($id)
    {
        return new StudentResource(Model::find($id));
    }

    public function login(Request $request)
    {
        $credentials = StudentService::getCredentials($request);
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['invalid_email_or_password'], 422);
            }
        } catch (JWTException $e) {
            return response()->json(['Failed_to_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

}


class StudentService
{
    public static function getCredentials($request)
    {
        return $request->only('email', 'password');
    }
}