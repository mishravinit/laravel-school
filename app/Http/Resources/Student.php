<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Student extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
//            'id' => $this->id,
            "class_room_id" => $this->class_room_id,
//            "student_id" => $this->student_id,
            "day_of_the_week" => $this->day_of_the_week,
            "start_time" => $this->start_time,
            "end_time" => $this->end_time,
            "on_week" => $this->on_week,
//            "lecture_id" => $this->lecture_id

        ];
    }

}
