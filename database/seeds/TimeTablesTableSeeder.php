<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeTablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days_of_week = 7;


        for ($i = 1; $i < $days_of_week; $i++) {
            if (TimeTablesTableSeederService::getRandom()) {
                DB::table('time_tables')->insert([
                    'student_id' => 1,
                    'class_room_id' => $i,
                    'day_of_the_week' => $i + 1,
                    'start_time' => rand(7, 9) . ':30:00',
                    'end_time' => rand(10, 12) . ':30:00',
                    'on_week' => json_encode(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11))
                ]);
            }
        }

        for ($i = 1; $i < $days_of_week; $i++) {
            if (TimeTablesTableSeederService::getRandom()) {
                DB::table('time_tables')->insert([
                    'student_id' => 1,
                    'class_room_id' => $i + ($days_of_week - 1),
                    'day_of_the_week' => $i + 1,
                    'start_time' => rand(13, 15) . ':30:00',
                    'end_time' => rand(15, 17) . ':30:00',
                    'on_week' => json_encode(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11))
                ]);
            }
        }

    }
}

Class TimeTablesTableSeederService
{
    public static function getRandom()
    {
        $n = rand(0, 1);
        if ($n == 0) {
            return true;
        } else return false;
    }
}
