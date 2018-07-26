<?php
/**
 * Created by PhpStorm.
 * User: Sprise
 * Date: 7/26/2018
 * Time: 8:26 PM
 */

namespace App\Services;

use App\Student as Model;

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