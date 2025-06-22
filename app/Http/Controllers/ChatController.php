<?php

namespace App\Http\Controllers;
use App\Models\Chat;
use App\Models\Message;
use App\Events\NewMessage;
use Illuminate\Http\Request;
use App\Models\Chalet;

class ChatController extends Controller
{
    // بدء محادثة جديدة
    public function startChat(Chalet $chalet)
    {
        $user = auth()->user();
        $owner = $chalet->owner;

        // البحث عن محادثة موجودة أو إنشاء محادثة جديدة
        $chat = Chat::firstOrCreate([
            'user_id' => $user->id,
            'owner_id' => $owner->id,
        ]);

        // جلب الرسائل
        $messages = $chat->messages()->with('sender')->latest()->take(50)->get()->reverse();

        return view('chat.show', compact('chat', 'messages', 'chalet'));
    }

    // إرسال رسالة
    public function sendMessage(Request $request, Chat $chat)
    {
        $request->validate(['message' => 'required|string']);

        // التأكد من أن المرسل مشارك في المحادثة
        if (!in_array(auth()->id(), [$chat->user_id, $chat->owner_id])) {
            abort(403);
        }

        $message = $chat->messages()->create([
            'sender_id' => auth()->id(),
            'message' => $request->message
        ]);

        event(new NewMessage($message));

        return response()->json($message);
    }

    // List all chats for owner
public function ownerChats()
{
    $owner = auth()->user();
    $chats = Chat::with(['user', 'message' => fn($q) => $q->latest()->limit(1)])
                ->where('owner_id', $owner->id)
                ->get();

    return view('owner.chats.index', compact('chats'));
}

// Show specific chat for owner
public function showOwnerChat(Chat $chat)
{
    // Mark messages as read
$chat->message()
    ->where('sender_id', '!=', auth()->id())
    ->whereNull('read_at')
    ->update(['read_at' => now()]);

    if ($chat->owner_id !== auth()->id()) abort(403);

    $chat->load('user');
    $message = $chat->message()
                ->with('sender')
                ->latest()
                ->take(50)
                ->get()
                ->reverse();

    return view('owner.chat.show', [
        'chat' => $chat,
        'message' => $message,
        'recipient' => $chat->user
    ]);
}
    
}