<?php

namespace Database\Seeders;

use App\Models\ClassSession;
use Illuminate\Database\Seeder;

class ClassSessionSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            ['name' => 'Mathematics IV', 'teacher' => 'Anita Kapoor', 'time' => '08:00 - 09:30', 'room' => 'Lab 02', 'status' => 'In session'],
            ['name' => 'Modern Literature', 'teacher' => 'Luis Ortega', 'time' => '10:00 - 11:00', 'room' => 'C14', 'status' => 'Starts soon'],
            ['name' => 'Physics Lab', 'teacher' => 'Chloe Miller', 'time' => '11:15 - 12:45', 'room' => 'Lab 05', 'status' => 'Ready'],
            ['name' => 'Entrepreneurship', 'teacher' => 'Kwame Mensah', 'time' => '14:00 - 15:00', 'room' => 'Innovation Hub', 'status' => 'Assigned'],
            ['name' => 'World History', 'teacher' => 'Sofia Rahman', 'time' => '15:30 - 16:30', 'room' => 'B12', 'status' => 'Prep'],
        ];

        foreach ($classes as $class) {
            ClassSession::updateOrCreate(
                ['name' => $class['name'], 'teacher' => $class['teacher']],
                $class
            );
        }
    }
}
