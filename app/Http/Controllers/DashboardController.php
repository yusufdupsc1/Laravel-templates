<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $dashboard = [
            'stats' => [
                [
                    'label' => 'Active Students',
                    'value' => '1,240',
                    'change' => '+3.2% vs last term',
                    'badge' => 'Enrolled',
                ],
                [
                    'label' => 'Attendance',
                    'value' => '95%',
                    'change' => '+1.4% this week',
                    'badge' => 'Live',
                ],
                [
                    'label' => 'Fees Collected',
                    'value' => '72%',
                    'change' => '+3.9% MoM',
                    'badge' => 'Finance',
                ],
                [
                    'label' => 'Faculty Coverage',
                    'value' => '38 classes',
                    'change' => '12 open periods',
                    'badge' => 'Staffing',
                ],
            ],
            'attendanceTrend' => [
                'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Today'],
                'values' => [95, 96, 94, 93, 97, 95],
            ],
            'feesStatus' => [
                'labels' => ['Paid', 'Pending', 'Overdue'],
                'values' => [72, 18, 10],
            ],
            'gradeDistribution' => [
                'labels' => ['A', 'B', 'C', 'D', 'Support'],
                'values' => [38, 42, 15, 4, 1],
            ],
            'classes' => [
                [
                    'name' => 'Mathematics IV',
                    'teacher' => 'Anita Kapoor',
                    'time' => '08:00 - 09:30',
                    'room' => 'Lab 02',
                    'fill' => '92%',
                    'status' => 'In session',
                ],
                [
                    'name' => 'Modern Literature',
                    'teacher' => 'Luis Ortega',
                    'time' => '10:00 - 11:00',
                    'room' => 'C14',
                    'fill' => '88%',
                    'status' => 'Starts soon',
                ],
                [
                    'name' => 'Physics Lab',
                    'teacher' => 'Chloe Miller',
                    'time' => '11:15 - 12:45',
                    'room' => 'Lab 05',
                    'fill' => '94%',
                    'status' => 'Ready',
                ],
                [
                    'name' => 'Entrepreneurship',
                    'teacher' => 'Kwame Mensah',
                    'time' => '14:00 - 15:00',
                    'room' => 'Innovation Hub',
                    'fill' => '81%',
                    'status' => 'Assigned',
                ],
            ],
            'students' => [
                [
                    'name' => 'Leah Porter',
                    'grade' => '12 Science',
                    'gpa' => '3.94',
                    'progress' => 92,
                    'trend' => '+4.1%',
                ],
                [
                    'name' => 'Hamza Ali',
                    'grade' => '11 Arts',
                    'gpa' => '3.76',
                    'progress' => 88,
                    'trend' => '+2.3%',
                ],
                [
                    'name' => 'Maya Chen',
                    'grade' => '10 STEM',
                    'gpa' => '3.82',
                    'progress' => 90,
                    'trend' => '+3.0%',
                ],
                [
                    'name' => 'Ethan Carter',
                    'grade' => '12 Commerce',
                    'gpa' => '3.71',
                    'progress' => 85,
                    'trend' => '+1.7%',
                ],
            ],
            'events' => [
                [
                    'title' => 'STEM Innovation Fair',
                    'time' => 'Today • 3:30 PM',
                    'badge' => 'Campus',
                    'description' => '20 teams showcasing prototypes with investor panel.',
                ],
                [
                    'title' => 'Parent-Teacher 1:1s',
                    'time' => 'Tomorrow • 9:00 AM',
                    'badge' => 'Community',
                    'description' => 'Grade 10-12 progress reviews and next-term planning.',
                ],
                [
                    'title' => 'Sports Trials',
                    'time' => 'Friday • 7:30 AM',
                    'badge' => 'Athletics',
                    'description' => 'Track, football, and basketball rosters finalization.',
                ],
            ],
            'activity' => [
                ['title' => 'Attendance locked', 'meta' => 'Grade 12 • 10 mins ago'],
                ['title' => 'New enrolment', 'meta' => 'Student ID #1241 • 32 mins ago'],
                ['title' => 'Fees reconciled', 'meta' => 'Batch April • 1 hr ago'],
                ['title' => 'Lesson plan approved', 'meta' => 'Physics Lab • 2 hrs ago'],
                ['title' => 'Incident resolved', 'meta' => 'Hall B • 3 hrs ago'],
            ],
            'messages' => [
                [
                    'from' => 'Finance',
                    'title' => 'Overdue fee reminders sent',
                    'body' => 'Automated reminders dispatched to 32 guardians. Next follow-up in 48h.',
                ],
                [
                    'from' => 'Facilities',
                    'title' => 'AC maintenance scheduled',
                    'body' => 'Cooling maintenance for Block C, rooms offline Saturday 8-11am.',
                ],
                [
                    'from' => 'Counseling',
                    'title' => 'Wellness checks',
                    'body' => 'Advisors meeting with Grade 9 students flagged for low engagement.',
                ],
            ],
        ];

        $dashboard['charts'] = [
            'attendanceTrend' => $dashboard['attendanceTrend'],
            'feesStatus' => $dashboard['feesStatus'],
            'gradeDistribution' => $dashboard['gradeDistribution'],
        ];

        return view('dashboard', ['dashboard' => $dashboard]);
    }
}
