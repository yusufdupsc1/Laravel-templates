<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use App\Jobs\SendMessageNotifications;

class MessagesController extends Controller
{
    public function index(): View
    {
        $threads = Message::latest()->paginate(10);

        return view('messages', [
            'threads' => $threads,
            'inbox' => $threads->getCollection()->take(4),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'author' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'priority' => ['required', 'string', 'max:50'],
        ]);

        $message = Message::create($validated);
        // Queue notification delivery (email + SMS log placeholder)
        dispatch(new SendMessageNotifications($message));
        Cache::forget('dashboard-data');

        return redirect()->route('messages.index')->with('status', 'Message posted');
    }

    public function destroy(Message $message): RedirectResponse
    {
        $message->delete();
        Cache::forget('dashboard-data');

        return redirect()->route('messages.index')->with('status', 'Message archived');
    }
}
