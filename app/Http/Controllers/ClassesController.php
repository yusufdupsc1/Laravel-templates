<?php

namespace App\Http\Controllers;

use App\Models\ClassSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ClassesController extends Controller
{
    public function index(): View
    {
        $total = ClassSession::count();
        $inSession = ClassSession::where('status', 'In session')->count();
        $labs = ClassSession::where('room', 'like', 'Lab%')->count();
        $prep = ClassSession::where('status', 'Prep')->count();

        return view('classes', [
            'classes' => ClassSession::orderBy('time')->paginate(10),
            'metrics' => [
                'total' => $total,
                'in_session' => $inSession,
                'labs' => $labs,
                'prep' => $prep,
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'teacher' => ['required', 'string', 'max:255'],
            'time' => ['required', 'string', 'max:255'],
            'room' => ['required', 'string', 'max:50'],
            'status' => ['required', 'string', 'max:50'],
        ]);

        ClassSession::create($validated);
        Cache::forget('dashboard-data');

        return redirect()->route('classes.index')->with('status', 'Class added');
    }

    public function update(Request $request, ClassSession $class): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'teacher' => ['required', 'string', 'max:255'],
            'time' => ['required', 'string', 'max:255'],
            'room' => ['required', 'string', 'max:50'],
            'status' => ['required', 'string', 'max:50'],
        ]);

        $class->update($validated);
        Cache::forget('dashboard-data');

        return redirect()->route('classes.index')->with('status', 'Class updated');
    }

    public function destroy(ClassSession $class): RedirectResponse
    {
        $class->delete();
        Cache::forget('dashboard-data');

        return redirect()->route('classes.index')->with('status', 'Class removed');
    }
}
