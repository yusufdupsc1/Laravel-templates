<?php

namespace App\Http\Controllers;

class AttendanceController extends Controller
{
    public function __invoke()
    {
        $summary = [
            ['label' => 'Present', 'value' => '95%', 'detail' => 'Live average today'],
            ['label' => 'Late', 'value' => '2.4%', 'detail' => 'Last hour'],
            ['label' => 'Excused', 'value' => '1.1%', 'detail' => 'Health + travel'],
            ['label' => 'Unmarked', 'value' => '6 classes', 'detail' => 'Follow-up needed'],
        ];

        $grades = [
            ['grade' => 'Grade 12', 'present' => 96, 'late' => 2, 'unmarked' => 0],
            ['grade' => 'Grade 11', 'present' => 94, 'late' => 3, 'unmarked' => 1],
            ['grade' => 'Grade 10', 'present' => 93, 'late' => 3, 'unmarked' => 2],
            ['grade' => 'Grade 9', 'present' => 95, 'late' => 2, 'unmarked' => 1],
        ];

        return view('attendance', compact('summary', 'grades'));
    }
}
