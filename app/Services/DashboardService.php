<?php

namespace App\Services;

use App\Models\AttendanceSummary;
use App\Models\ClassSession;
use App\Models\Invoice;
use App\Models\Message;
use App\Models\Student;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getData(): array
    {
        // Optimized queries
        $studentCount = Student::count();
        $avgGpa = Student::avg('gpa');
        $classCount = ClassSession::count();
        $attendanceAvg = AttendanceSummary::avg('present') ?? 0;

        // Optimized finance queries
        $paidAmount = Invoice::where('status', 'Paid')->sum('amount');
        $pendingAmount = Invoice::where('status', 'Pending')->sum('amount');
        $totalAmount = Invoice::sum('amount');
        $profitEstimate = $paidAmount * 0.22; // simple margin estimate

        $feesTotals = $this->collections($totalAmount, $paidAmount, $pendingAmount);
        $gradeDistribution = $this->gradeDistribution();

        // Keep frontend-facing structure
        $lineLabels = ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $incomeSeries = array_fill(0, count($lineLabels), max($paidAmount, 0));
        $expenseSeries = array_fill(0, count($lineLabels), max($pendingAmount, 0));

        return [
            'overview' => [
                ['label' => 'Students', 'value' => number_format($studentCount), 'trend' => '+3.2% vs last term'],
                ['label' => 'Faculty', 'value' => '78', 'trend' => '+2 hired'],
                ['label' => 'Average GPA', 'value' => number_format($avgGpa, 2), 'trend' => '+0.1 YoY'],
                ['label' => 'Guardian response', 'value' => '91%', 'trend' => '+6% this week'],
            ],
            'financeCards' => [
                ['label' => 'Total Students', 'value' => number_format($studentCount), 'sub' => 'This Month'],
                ['label' => 'Total Employees', 'value' => '78', 'sub' => 'This Month'],
                ['label' => 'Revenue', 'value' => '$' . number_format($paidAmount, 0), 'sub' => 'This Month'],
                ['label' => 'Total Profit', 'value' => '$' . number_format($profitEstimate, 0), 'sub' => 'This Month'],
            ],
            'stats' => [
                ['label' => 'Attendance', 'value' => number_format($attendanceAvg, 1) . '%', 'caption' => 'Live across all grades', 'trend' => '+1.4% this week'],
                ['label' => 'Fees collected', 'value' => $feesTotals['paidPercent'] . '%', 'caption' => 'Term-wise reconciliation', 'trend' => '+3.9% MoM'],
                ['label' => 'Teacher coverage', 'value' => $classCount . ' classes', 'caption' => '0 unassigned periods', 'trend' => 'Stable'],
                ['label' => 'System health', 'value' => '99.9%', 'caption' => 'APIs, SIS, comms', 'trend' => 'No incidents'],
            ],
            'charts' => [
                'line' => [
                    'labels' => $lineLabels,
                    'datasets' => [
                        ['label' => 'Income', 'data' => $incomeSeries],
                        ['label' => 'Expenses', 'data' => $expenseSeries],
                    ],
                ],
                'feesStatus' => [
                    'labels' => ['Paid', 'Pending', 'Overdue'],
                    'values' => [$feesTotals['paidPercent'], $feesTotals['pendingPercent'], $feesTotals['overduePercent']],
                ],
                'gradeDistribution' => [
                    'labels' => ['3.5 - 4.0', '3.0 - 3.49', '2.5 - 2.99', '< 2.5'],
                    'values' => $gradeDistribution,
                ],
            ],
            'fees' => [
                'labels' => ['Paid', 'Pending', 'Overdue'],
                'values' => [$feesTotals['paidPercent'], $feesTotals['pendingPercent'], $feesTotals['overduePercent']],
            ],
            'classes' => ClassSession::orderBy('time')->limit(10)->get(), // Limit for display
            'students' => Student::orderBy('gpa', 'desc')->take(3)->get()->map(function ($student) {
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
            'today' => [
                'studentsPresent' => number_format($attendanceAvg, 1),
                'employeesPresent' => 92.0,
                'feeCollection' => $feesTotals['paidPercent'],
            ],
            'feesAmount' => [
                'paid' => $paidAmount,
                'pending' => $pendingAmount,
                'total' => $totalAmount,
            ],
            'calendar' => $this->buildCalendar(Carbon::now()),
        ];
    }

    private function collections($total, $paid, $pending): array
    {
        $total = $total ?: 1;
        $overdue = $total - $paid - $pending; // Assumes what is not paid or pending is overdue

        $percent = fn ($value) => round(($value / $total) * 100);

        return [
            'paidPercent' => $percent($paid),
            'pendingPercent' => $percent($pending),
            'overduePercent' => $percent($overdue),
        ];
    }

    private function gradeDistribution(): array
    {
        // Single, efficient query for grade distribution
        $distribution = Student::select(
            DB::raw('SUM(CASE WHEN gpa BETWEEN 3.5 AND 4.0 THEN 1 ELSE 0 END) as "3.5-4.0"'),
            DB::raw('SUM(CASE WHEN gpa BETWEEN 3.0 AND 3.49 THEN 1 ELSE 0 END) as "3.0-3.49"'),
            DB::raw('SUM(CASE WHEN gpa BETWEEN 2.5 AND 2.99 THEN 1 ELSE 0 END) as "2.5-2.99"'),
            DB::raw('SUM(CASE WHEN gpa < 2.5 THEN 1 ELSE 0 END) as "<2.5"')
        )->first()->toArray();

        return array_values($distribution);
    }

    private function buildCalendar(Carbon $date): array
    {
        $start = $date->copy()->startOfMonth()->startOfWeek(Carbon::SUNDAY);
        $end = $date->copy()->endOfMonth()->endOfWeek(Carbon::SATURDAY);

        $weeks = [];
        $cursor = $start->copy();
        while ($cursor <= $end) {
            $week = [];
            for ($i = 0; $i < 7; $i++) {
                $week[] = [
                    'day' => $cursor->day,
                    'in_month' => $cursor->month === $date->month,
                    'is_today' => $cursor->isToday(),
                ];
                $cursor->addDay();
            }
            $weeks[] = $week;
        }

        return [
            'month' => $date->format('F Y'),
            'weeks' => $weeks,
        ];
    }
}
