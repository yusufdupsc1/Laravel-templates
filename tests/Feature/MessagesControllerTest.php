<?php

namespace Tests\Feature;

use App\Jobs\SendMessageNotifications;
use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class MessagesControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_stores_a_message_and_dispatches_a_job()
    {
        Bus::fake();

        $data = [
            'author' => 'John Doe',
            'subject' => 'Test Subject',
            'body' => 'Test Body',
            'priority' => 'High',
        ];

        $response = $this->post(route('messages.store'), $data);

        $response->assertRedirect(route('messages.index'));
        $response->assertSessionHas('status', 'Message posted');

        $this->assertDatabaseHas('messages', $data);

        Bus::assertDispatched(SendMessageNotifications::class, function ($job) use ($data) {
            return $job->message->subject === $data['subject'];
        });
    }

    /** @test */
    public function it_deletes_a_message()
    {
        $message = Message::factory()->create();

        $response = $this->delete(route('messages.destroy', $message));

        $response->assertRedirect(route('messages.index'));
        $response->assertSessionHas('status', 'Message archived');

        $this->assertSoftDeleted('messages', ['id' => $message->id]);
    }
}
