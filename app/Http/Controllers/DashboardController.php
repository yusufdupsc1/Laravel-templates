<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $dashboard = [
            'overview' => [
                ['label' => 'Students', 'value' => '1,240', 'trend' => '+3.2% vs last term'],
                ['label' => 'Faculty', 'value' => '78', 'trend' => '+2 hired'],
                ['label' => 'Average GPA', 'value' => '3.78', 'trend' => '+0.2 YoY'],
                ['label' => 'Guardian response', 'value' => '91%', 'trend' => '+6% this week'],
            ],
            'stats' => [
                ['label' => 'Attendance', 'value' => '95%', 'caption' => 'Live across all grades', 'trend' => '+1.4% this week'],
                ['label' => 'Fees collected', 'value' => '72%', 'caption' => 'Term-wise reconciliation', 'trend' => '+3.9% MoM'],
                ['label' => 'Teacher coverage', 'value' => '38 classes', 'caption' => '0 unassigned periods', 'trend' => 'Stable'],
                ['label' => 'System health', 'value' => '99.9%', 'caption' => 'APIs, SIS, comms', 'trend' => 'No incidents'],
            ],
            'charts' => [
                'attendanceTrend' => [
                    'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Today'],
                    'values' => [95, 96, 94, 93, 97, 95],
                ],
                'feesStatus' => [
                    'labels' => ['Paid', 'Pending', 'Overdue'],
                    'values' => [72, 18, 10],
                ],
                'gradeDistribution' => [
                    'labels' => ['A', 'B', 'C', 'Support'],
                    'values' => [38, 42, 17, 3],
                ],
            ],
            'fees' => [
                'labels' => ['Paid', 'Pending', 'Overdue'],
                'values' => [72, 18, 10],
            ],
            'classes' => [
                ['name' => 'Mathematics IV', 'teacher' => 'Anita Kapoor', 'time' => '08:00 - 09:30', 'room' => 'Lab 02', 'status' => 'In session'],
                ['name' => 'Modern Literature', 'teacher' => 'Luis Ortega', 'time' => '10:00 - 11:00', 'room' => 'C14', 'status' => 'Starts soon'],
                ['name' => 'Physics Lab', 'teacher' => 'Chloe Miller', 'time' => '11:15 - 12:45', 'room' => 'Lab 05', 'status' => 'Ready'],
                ['name' => 'Entrepreneurship', 'teacher' => 'Kwame Mensah', 'time' => '14:00 - 15:00', 'room' => 'Innovation Hub', 'status' => 'Assigned'],
            ],
            'students' => [
                ['name' => 'Leah Porter', 'grade' => '12 Science', 'gpa' => '3.94', 'progress' => 92, 'trend' => '+4.1%'],
                ['name' => 'Hamza Ali', 'grade' => '11 Arts', 'gpa' => '3.76', 'progress' => 88, 'trend' => '+2.3%'],
                ['name' => 'Maya Chen', 'grade' => '10 STEM', 'gpa' => '3.82', 'progress' => 90, 'trend' => '+3.0%'],
            ],
            'activity' => [
                ['title' => 'Attendance locked', 'meta' => 'Grade 12 • 10 mins ago'],
                ['title' => 'New enrolment', 'meta' => 'Student ID #1241 • 32 mins ago'],
                ['title' => 'Fees reconciled', 'meta' => 'Batch April • 1 hr ago'],
                ['title' => 'Lesson plan approved', 'meta' => 'Physics Lab • 2 hrs ago'],
            ],
        ];

        return view('dashboard', ['dashboard' => $dashboard]);
    }
}
