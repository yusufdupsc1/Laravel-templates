<?php

namespace Database\Seeders;

use App\Models\AttendanceSummary;
use Illuminate\Database\Seeder;

class AttendanceSummarySeeder extends Seeder
{
    public function run(): void
    {
        $grades = [
            ['grade' => 'Grade 12', 'present' => 96, 'late' => 2, 'unmarked' => 0],
            ['grade' => 'Grade 11', 'present' => 94, 'late' => 3, 'unmarked' => 1],
            ['grade' => 'Grade 10', 'present' => 93, 'late' => 3, 'unmarked' => 2],
            ['grade' => 'Grade 9', 'present' => 95, 'late' => 2, 'unmarked' => 1],
        ];

        foreach ($grades as $grade) {
            AttendanceSummary::updateOrCreate(
                ['grade' => $grade['grade']],
                $grade
            );
        }
    }
}
