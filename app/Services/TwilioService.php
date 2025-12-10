<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class TwilioService
{
    private ?Client $client;
    private ?string $from;
    private ?string $to;

    public function __construct()
    {
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $this->from = config('services.twilio.from');
        $this->to = config('services.twilio.to');

        if ($sid && $token) {
            $this->client = new Client($sid, $token);
        } else {
            $this->client = null;
        }
    }

    public function sendSms(string $subject, string $body, string $priority): void
    {
        if (!$this->client || !$this->from || !$this->to) {
            Log::info('Twilio SMS skipped: missing configuration');
            return;
        }

        try {
            $this->client->messages->create($this->to, [
                'from' => $this->from,
                'body' => "[{$priority}] {$subject} - {$body}",
            ]);
        } catch (\Throwable $e) {
            Log::error('Twilio SMS failed', ['error' => $e->getMessage()]);
        }
    }
}
