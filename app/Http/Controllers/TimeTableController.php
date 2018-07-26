<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TimeTable as Model;
use App\Exceptions;


class TimeTableController extends Controller
{
    public function index($id)
    {
        try {
            $model = TimeTableService::getById($id);
        } catch (\Exception $e) {
            return TimeTableService::getFailMessageByServer($e);
        }
        return $model;
    }
}


class TimeTableService
{

    public static function getById($id)
    {
        return Model::where('student_id', '=', $id)
            ->firstOrFail()
            ->with('student')
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