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

    public function getFailMessageByServer($e)
    {
        return response()->json([
            'error_code' => '0002',
            'error_message' => 'general_error',
            'error_message_extra' => $e->getMessage()
        ]);
    }

    public function getCustomFailMessageByServer($message)
    {
        return response()->json([
            'error_code' => '0002',
            'error_message' => $message
        ]);
    }

    public function getCustomFailMessageByClient($message)
    {
        return response()->json([
            'error_code' => '0001',
            'error_message' => $message
        ]);
    }

}