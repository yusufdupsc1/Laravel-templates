<?php

namespace App\Http\Controllers;

class MessagesController extends Controller
{
    public function __invoke()
    {
        $threads = [
            ['title' => 'Overdue fee reminders sent', 'author' => 'Finance', 'time' => '10 mins ago', 'body' => 'Automated reminders dispatched to 32 guardians. Next follow-up in 48h.', 'priority' => 'High'],
            ['title' => 'AC maintenance scheduled', 'author' => 'Facilities', 'time' => '30 mins ago', 'body' => 'Cooling maintenance for Block C, rooms offline Saturday 8-11am.', 'priority' => 'Normal'],
            ['title' => 'Wellness checks', 'author' => 'Counseling', 'time' => '1 hr ago', 'body' => 'Advisors meeting with Grade 9 students flagged for low engagement.', 'priority' => 'Normal'],
            ['title' => 'Field trip approvals', 'author' => 'Grade 10 Lead', 'time' => '2 hrs ago', 'body' => 'Consent forms needed by Friday for museum trip.', 'priority' => 'High'],
        ];

        $inbox = [
            ['from' => 'Guardian - Porter', 'subject' => 'Medical leave update', 'time' => '5 mins ago'],
            ['from' => 'Vendor - LabTech', 'subject' => 'Equipment shipment', 'time' => '25 mins ago'],
            ['from' => 'Teacher - Rahman', 'subject' => 'Schedule swap request', 'time' => '1 hr ago'],
            ['from' => 'Student - Chen', 'subject' => 'Transcript request', 'time' => '1 hr ago'],
        ];

        return view('messages', compact('threads', 'inbox'));
    }
}
