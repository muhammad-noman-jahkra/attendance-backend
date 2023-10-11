<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AttendanceFault;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LocationSeeder::class);
        $this->call(ShiftSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(AttendanceSeeder::class);
        $this->call(AttendanceFaultSeeder::class);
        
    }
}
