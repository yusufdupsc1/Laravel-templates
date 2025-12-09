<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            ['name' => 'Administration', 'members' => 8, 'role' => 'Full access'],
            ['name' => 'Academic Leads', 'members' => 12, 'role' => 'Curriculum + reports'],
            ['name' => 'Finance', 'members' => 6, 'role' => 'Payments + invoicing'],
            ['name' => 'Counseling', 'members' => 5, 'role' => 'Student support'],
        ];

        foreach ($teams as $team) {
            Team::updateOrCreate(['name' => $team['name']], $team);
        }
    }
}
