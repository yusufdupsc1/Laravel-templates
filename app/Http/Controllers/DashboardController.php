<?php

namespace App\Http\Controllers;

use App\Models\AttendanceSummary;
use App\Models\ClassSession;
use App\Models\Invoice;
use App\Models\Message;
use App\Models\Student;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $dashboard = Cache::remember('dashboard-data', 300, function () {
            // Keep dashboard lean: cache derived aggregates for 5 minutes
            $students = Student::all();
            $classes = ClassSession::orderBy('time')->get();
            $invoices = Invoice::all();
            $attendance = AttendanceSummary::all();

            $feesTotals = $this->collections($invoices);
            $attendanceAvg = $attendance->avg('present') ?? 0;

            return [
                'overview' => [
                    ['label' => 'Students', 'value' => number_format($students->count()), 'trend' => '+3.2% vs last term'],
                    ['label' => 'Faculty', 'value' => '78', 'trend' => '+2 hired'],
                    ['label' => 'Average GPA', 'value' => number_format($students->avg('gpa'), 2), 'trend' => '+0.1 YoY'],
                    ['label' => 'Guardian response', 'value' => '91%', 'trend' => '+6% this week'],
                ],
                'stats' => [
                    ['label' => 'Attendance', 'value' => number_format($attendanceAvg, 1) . '%', 'caption' => 'Live across all grades', 'trend' => '+1.4% this week'],
                    ['label' => 'Fees collected', 'value' => $feesTotals['paidPercent'] . '%', 'caption' => 'Term-wise reconciliation', 'trend' => '+3.9% MoM'],
                    ['label' => 'Teacher coverage', 'value' => $classes->count() . ' classes', 'caption' => '0 unassigned periods', 'trend' => 'Stable'],
                    ['label' => 'System health', 'value' => '99.9%', 'caption' => 'APIs, SIS, comms', 'trend' => 'No incidents'],
                ],
                'charts' => [
                    'attendanceTrend' => [
                        'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Today'],
                        'values' => [95, 96, 94, 93, 97, 95],
                    ],
                    'feesStatus' => [
                        'labels' => ['Paid', 'Pending', 'Overdue'],
                        'values' => [$feesTotals['paidPercent'], $feesTotals['pendingPercent'], $feesTotals['overduePercent']],
                    ],
                    'gradeDistribution' => [
                        'labels' => ['3.5 - 4.0', '3.0 - 3.49', '2.5 - 2.99', '< 2.5'],
                        'values' => $this->gradeDistribution($students),
                    ],
                ],
                'fees' => [
                    'labels' => ['Paid', 'Pending', 'Overdue'],
                    'values' => [$feesTotals['paidPercent'], $feesTotals['pendingPercent'], $feesTotals['overduePercent']],
                ],
                'classes' => $classes,
                'students' => $students->take(3)->map(function ($student) {
                    $progress = round(($student->gpa / 4) * 100);

                    return [
                        'name' => $student->name,
                        'grade' => $student->grade,
                        'gpa' => number_format($student->gpa, 2),
                        'progress' => $progress,
                        'trend' => '+'.max(1, rand(1, 5)).'%'
                    ];
                }),
                'activity' => Message::latest()->take(4)->get()->map(fn ($message) => [
                    'title' => $message->subject,
                    'meta' => $message->author . ' • ' . $message->created_at->diffForHumans(),
                ]),
            ];
        });

        return view('dashboard', ['dashboard' => $dashboard]);
    }

    private function collections($invoices): array
    {
        $total = $invoices->sum('amount') ?: 1;
        $paid = $invoices->where('status', 'Paid')->sum('amount');
        $pending = $invoices->where('status', 'Pending')->sum('amount');
        $overdue = $invoices->where('status', 'Overdue')->sum('amount');

        $percent = fn ($value) => round(($value / $total) * 100);

        return [
            'paidPercent' => $percent($paid),
            'pendingPercent' => $percent($pending),
            'overduePercent' => $percent($overdue),
        ];
    }

    private function gradeDistribution($students): array
    {
        $bands = [
            '3.5 - 4.0' => [3.5, 4],
            '3.0 - 3.49' => [3.0, 3.49],
            '2.5 - 2.99' => [2.5, 2.99],
            '< 2.5' => [0, 2.49],
        ];

        $values = [];
        foreach ($bands as $range) {
            [$min, $max] = $range;
            $values[] = $students->where('gpa', '>=', $min)->where('gpa', '<=', $max)->count();
        }

        return $values;
    }
}
