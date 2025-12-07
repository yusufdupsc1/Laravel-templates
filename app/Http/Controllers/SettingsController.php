<?php

namespace App\Http\Controllers;

class SettingsController extends Controller
{
    public function __invoke()
    {
        $settings = [
            ['name' => 'Two-factor authentication', 'enabled' => true, 'description' => 'Require OTP for admin sign-in'],
            ['name' => 'Guardian notifications', 'enabled' => true, 'description' => 'Send alerts for fees, attendance, and incidents'],
            ['name' => 'Data exports', 'enabled' => false, 'description' => 'Allow CSV exports for staff'],
            ['name' => 'Auto-sync SIS', 'enabled' => true, 'description' => 'Sync roster and grades nightly'],
        ];

        $teams = [
            ['name' => 'Administration', 'members' => 8, 'role' => 'Full access'],
            ['name' => 'Academic Leads', 'members' => 12, 'role' => 'Curriculum + reports'],
            ['name' => 'Finance', 'members' => 6, 'role' => 'Payments + invoicing'],
            ['name' => 'Counseling', 'members' => 5, 'role' => 'Student support'],
        ];

        return view('settings', compact('settings', 'teams'));
    }
}
