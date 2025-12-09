<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function __invoke(): View
    {
        return view('settings', [
            'settings' => Setting::orderBy('name')->get(),
            'teams' => Team::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'settings' => ['array'],
            'settings.*.id' => ['integer', 'exists:settings,id'],
            'settings.*.enabled' => ['boolean'],
        ]);

        if ($request->filled('settings')) {
            foreach ($request->settings as $settingData) {
                $setting = Setting::find($settingData['id']);
                if ($setting) {
                    $setting->update(['enabled' => (bool) ($settingData['enabled'] ?? false)]);
                }
            }
        }

        return redirect()->route('settings')->with('status', 'Settings updated');
    }
}
