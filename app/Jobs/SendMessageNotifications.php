<?php

namespace App\Jobs;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class SendMessageNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private Message $message)
    {
    }

    public function handle(): void
    {
        // Email blast (uses configured mailer; defaults to log)
        Mail::raw($this->message->body ?? $this->message->subject, function ($mail) {
            $mail->to(config('mail.from.address'))
                ->subject('[SchoolOps] ' . $this->message->subject);
        });

        // SMS dispatch placeholder for future provider integration
        Log::info('SMS dispatch queued', [
            'author' => $this->message->author,
            'subject' => $this->message->subject,
            'priority' => $this->message->priority,
        ]);

        $this->sendSms();
    }

    private function sendSms(): void
    {
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $from = config('services.twilio.from');
        $to = config('services.twilio.to');

        if (!($sid && $token && $from && $to)) {
            Log::info('Twilio SMS skipped: missing configuration');
            return;
        }

        try {
            $client = new Client($sid, $token);
            $client->messages->create($to, [
                'from' => $from,
                'body' => "[{$this->message->priority}] {$this->message->subject} - {$this->message->body}",
            ]);
        } catch (\Throwable $e) {
            Log::error('Twilio SMS failed', ['error' => $e->getMessage()]);
        }
    }
}
