<?php
/**
 * Created by PhpStorm.
 * User: Sprise
 * Date: 7/26/2018
 * Time: 7:15 PM
 */

namespace App\Services;

class MessageService
{
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

}