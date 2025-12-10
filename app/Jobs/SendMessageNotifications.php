<?php

namespace App\Jobs;

use App\Models\Message;
use App\Services\TwilioService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMessageNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private Message $message)
    {
    }

    public function handle(TwilioService $twilio): void
    {
        // Email blast (uses configured mailer; defaults to log)
        Mail::raw($this->message->body ?? $this->message->subject, function ($mail) {
            $mail->to(config('mail.from.address'))
                ->subject('[SchoolOps] ' . $this->message->subject);
        });

        $twilio->sendSms(
            $this->message->subject,
            $this->message->body ?? '',
            $this->message->priority
        );
    }
}
