<?php

namespace App\Http\Controllers;

class StudentsController extends Controller
{
    public function __invoke()
    {
        $students = [
            ['name' => 'Leah Porter', 'grade' => '12 Science', 'gpa' => '3.94', 'status' => 'Active', 'guardian' => 'Daniel Porter', 'contact' => '+1 555 120 4421'],
            ['name' => 'Hamza Ali', 'grade' => '11 Arts', 'gpa' => '3.76', 'status' => 'Active', 'guardian' => 'Sarah Ali', 'contact' => '+1 555 660 2133'],
            ['name' => 'Maya Chen', 'grade' => '10 STEM', 'gpa' => '3.82', 'status' => 'Watch', 'guardian' => 'Lina Chen', 'contact' => '+1 555 874 0034'],
            ['name' => 'Ethan Carter', 'grade' => '12 Commerce', 'gpa' => '3.71', 'status' => 'Active', 'guardian' => 'George Carter', 'contact' => '+1 555 991 2044'],
            ['name' => 'Asha Patel', 'grade' => '9 STEM', 'gpa' => '3.58', 'status' => 'New', 'guardian' => 'Ravi Patel', 'contact' => '+1 555 284 3361'],
        ];

        return view('students', compact('students'));
    }
}
