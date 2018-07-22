<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'email' => 'phanthanhhuy@gmail.com',
            'name' => 'huy',
            'password' => bcrypt('123'),
            'admission_day' => 2014,
            'role' => 1
        ]);
    }
}
