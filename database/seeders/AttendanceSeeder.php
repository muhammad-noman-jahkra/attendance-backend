<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (\App\Models\Schedule::get() as $sch) {
            \App\Models\Attendance::create([
                'employee_id' => $sch->employee_id,
                'schedule_id' => $sch->id,
                'In' => '2023-10-08 09:'.rand(1, 59).':00',
                'Out' => '2023-10-08 18:'.rand(1, 59).':00',
            ]);    
        }

        foreach (\App\Models\Schedule::get() as $sch) {
            \App\Models\Attendance::create([
                'employee_id' => $sch->employee_id,
                'schedule_id' => $sch->id,
                'In' => '2023-10-09 09:'.rand(1, 59).':00',
                'Out' => '2023-10-09 18:'.rand(1, 59).':00',
            ]);    
        }
        
        foreach (\App\Models\Schedule::get() as $sch) {
            \App\Models\Attendance::create([
                'employee_id' => $sch->employee_id,
                'schedule_id' => $sch->id,
                'In' => '2023-10-10 09:'.rand(1, 59).':00',
                'Out' => '2023-10-10 18:'.rand(1, 59).':00',
            ]);    
        }
        
        foreach (\App\Models\Schedule::get() as $sch) {
            \App\Models\Attendance::create([
                'employee_id' => $sch->employee_id,
                'schedule_id' => $sch->id,
                'In' => '2023-10-11 09:'.rand(1, 59).':00',
                'Out' => '2023-10-11 18:'.rand(1, 59).':00',
            ]);    
        }
        
    }
}
