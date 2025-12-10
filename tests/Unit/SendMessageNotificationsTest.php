<?php

namespace Tests\Unit;

use App\Jobs\SendMessageNotifications;
use App\Models\Message;
use App\Services\TwilioService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendMessageNotificationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sends_an_email_and_sms()
    {
        Mail::fake();

        $message = Message::factory()->create([
            'subject' => 'Test Subject',
            'body' => 'Test Body',
            'priority' => 'High',
        ]);

        $twilioServiceMock = $this->createMock(TwilioService::class);
        $twilioServiceMock->expects($this->once())
            ->method('sendSms')
            ->with(
                'Test Subject',
                'Test Body',
                'High'
            );

        $job = new SendMessageNotifications($message);
        $job->handle($twilioServiceMock);

        Mail::assertSent(\Illuminate\Mail\Mailable::class, function ($mail) {
            return $mail->hasTo(config('mail.from.address')) &&
                   $mail->hasSubject('[SchoolOps] Test Subject');
        });
    }
}
