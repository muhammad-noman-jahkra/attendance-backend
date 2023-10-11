<?php

namespace Database\Factories;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AttendanceFault;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AttendanceFault>
 */
class AttendanceFaultFactory extends Factory
{
    protected $model = AttendanceFault::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $randAttId = rand(1, Attendance::count());
        $randAtt = Attendance::find($randAttId);
        return [
            'employee_id' => $randAtt->employee_id,
            'attendance_id' => $randAtt->id,
        ];
    }
}
