<?php

namespace App\Http\Controllers;

use App\Models\AttendanceSummary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function __invoke(): View
    {
        $grades = AttendanceSummary::orderBy('grade')->get();
        $presentAvg = $grades->avg('present') ?? 0;
        $lateAvg = $grades->avg('late') ?? 0;
        $unmarkedCount = $grades->where('unmarked', '>', 0)->count();

        return view('attendance', [
            'summary' => [
                ['label' => 'Present', 'value' => number_format($presentAvg, 1) . '%', 'detail' => 'Live average today'],
                ['label' => 'Late', 'value' => number_format($lateAvg, 1) . '%', 'detail' => 'Last hour'],
                ['label' => 'Excused', 'value' => '1.1%', 'detail' => 'Health + travel'],
                ['label' => 'Unmarked', 'value' => $unmarkedCount . ' classes', 'detail' => 'Follow-up needed'],
            ],
            'grades' => $grades,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'grades' => ['array'],
            'grades.*.id' => ['integer', 'exists:attendance_summaries,id'],
            'grades.*.present' => ['required', 'integer', 'between:0,100'],
            'grades.*.late' => ['required', 'integer', 'between:0,100'],
            'grades.*.unmarked' => ['required', 'integer', 'min:0'],
            'grades.*.locked' => ['nullable', 'boolean'],
        ]);

        foreach ($request->grades ?? [] as $gradeData) {
            $summary = AttendanceSummary::find($gradeData['id']);
            if ($summary && !$summary->locked) {
                $summary->update([
                    'present' => $gradeData['present'],
                    'late' => $gradeData['late'],
                    'unmarked' => $gradeData['unmarked'],
                    'locked' => (bool) ($gradeData['locked'] ?? false),
                ]);
            }
        }

        Cache::forget('dashboard-data');

        return redirect()->route('attendance')->with('status', 'Attendance updated');
    }
}
