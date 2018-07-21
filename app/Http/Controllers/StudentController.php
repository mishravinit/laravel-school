<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Student;
use App\Http\Resources\Student as StudentResource;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class StudentController extends Controller
{
    private $student;

    public function __construct(Student $student){
        $this->student = $student;
    }

    public function show($id)
    {
        return new StudentResource(Student::find($id));
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email','password');


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
