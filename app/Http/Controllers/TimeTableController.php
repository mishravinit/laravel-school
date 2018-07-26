<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentCollection;
use App\Services\StudentService;
use Illuminate\Http\Request;
use App\TimeTable as Model;
use App\Exceptions;

use App\Services\MessageService;

class TimeTableController extends Controller
{
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function index($id)
    {
        try {
            $model = TimeTableService::getById($id);
        } catch (\Exception $e) {
            return $this->messageService->getFailMessageByServer($e);
        }
        return $model;
    }
}


class TimeTableService
{

    public static function getById($id)
    {
        $model = Model::where('student_id', '=', $id)
            ->firstOrFail()
            ->with('student')
            ->get();
        return $model;
        $student = StudentService::getById($id);
//        return ;
//        return $model;
//        return new StudentCollection($model,$student);
    }


}