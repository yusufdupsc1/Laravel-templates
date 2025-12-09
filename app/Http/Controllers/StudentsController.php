<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudentsController extends Controller
{
    public function index(Request $request): View
    {
        $students = Student::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->q . '%')
                        ->orWhere('grade', 'like', '%' . $request->q . '%')
                        ->orWhere('guardian', 'like', '%' . $request->q . '%');
                });
            })
            ->when($request->filled('sort'), function ($query) use ($request) {
                $direction = $request->get('direction', 'asc');
                $query->orderBy($request->sort, $direction);
            }, fn ($q) => $q->orderBy('name'))
            ->paginate(10)
            ->appends($request->all());

        $metrics = [
            'active' => Student::where('status', 'Active')->count(),
            'new' => Student::where('status', 'New')->count(),
            'watch' => Student::where('status', 'Watch')->count(),
            'avgGpa' => number_format(Student::avg('gpa') ?? 0, 2),
        ];

        return view('students', [
            'students' => $students,
            'search' => $request->q,
            'sort' => $request->sort,
            'direction' => $request->get('direction', 'asc'),
            'metrics' => $metrics,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('students')->where('grade', $request->grade),
            ],
            'grade' => ['required', 'string', 'max:255'],
            'gpa' => ['required', 'numeric', 'between:0,4.00'],
            'status' => ['required', 'string', 'max:50'],
            'guardian' => ['nullable', 'string', 'max:255'],
            'contact' => ['nullable', 'string', 'max:255'],
        ]);

        Student::create($validated);
        Cache::forget('dashboard-data');

        return redirect()->route('students.index')->with('status', 'Student added');
    }

    public function update(Request $request, Student $student): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('students')->where('grade', $request->grade)->ignore($student->id),
            ],
            'grade' => ['required', 'string', 'max:255'],
            'gpa' => ['required', 'numeric', 'between:0,4.00'],
            'status' => ['required', 'string', 'max:50'],
            'guardian' => ['nullable', 'string', 'max:255'],
            'contact' => ['nullable', 'string', 'max:255'],
        ]);

        $student->update($validated);
        Cache::forget('dashboard-data');

        return redirect()->route('students.index')->with('status', 'Student updated');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();
        Cache::forget('dashboard-data');

        return redirect()->route('students.index')->with('status', 'Student removed');
    }

    public function export(Request $request)
    {
        $students = Student::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%');
            })
            ->orderBy('name')
            ->get();

        $csv = "Name,Grade,GPA,Status,Guardian,Contact\n";
        foreach ($students as $student) {
            $csv .= '"' . implode('","', [
                $student->name,
                $student->grade,
                $student->gpa,
                $student->status,
                $student->guardian,
                $student->contact,
            ]) . "\"\n";
        }

        return Response::make(rtrim($csv, "\n"), 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=students.csv',
        ]);
    }
}
