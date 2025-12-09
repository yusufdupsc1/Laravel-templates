<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $toggles = [
            ['name' => 'Two-factor authentication', 'description' => 'Require OTP for admin sign-in', 'enabled' => true],
            ['name' => 'Guardian notifications', 'description' => 'Send alerts for fees, attendance, and incidents', 'enabled' => true],
            ['name' => 'Data exports', 'description' => 'Allow CSV exports for staff', 'enabled' => false],
            ['name' => 'Auto-sync SIS', 'description' => 'Sync roster and grades nightly', 'enabled' => true],
        ];

        foreach ($toggles as $toggle) {
            Setting::updateOrCreate(['name' => $toggle['name']], $toggle);
        }
    }
}
