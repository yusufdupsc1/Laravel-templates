<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $messages = [
            ['author' => 'Finance', 'subject' => 'Overdue fee reminders sent', 'body' => 'Automated reminders dispatched to 32 guardians. Next follow-up in 48h.', 'priority' => 'High'],
            ['author' => 'Facilities', 'subject' => 'AC maintenance scheduled', 'body' => 'Cooling maintenance for Block C, rooms offline Saturday 8-11am.', 'priority' => 'Normal'],
            ['author' => 'Counseling', 'subject' => 'Wellness checks', 'body' => 'Advisors meeting with Grade 9 students flagged for low engagement.', 'priority' => 'Normal'],
            ['author' => 'Grade 10 Lead', 'subject' => 'Field trip approvals', 'body' => 'Consent forms needed by Friday for museum trip.', 'priority' => 'High'],
        ];

        foreach ($messages as $message) {
            Message::updateOrCreate(
                ['author' => $message['author'], 'subject' => $message['subject']],
                $message
            );
        }
    }
}
