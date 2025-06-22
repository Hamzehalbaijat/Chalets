<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with {{ $chalet->name }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif; /* Friendly and modern font */
            background-color: #f0f2f5; /* Soft light background */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            color: #333;
        }

        .container {
            max-width: 800px;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            background-color: #ffffff;
            overflow: hidden;
        }

        .card-header {
            background-color: #8e44ad; /* A friendly purple */
            color: white;
            padding: 1.2rem 1.5rem;
            border-bottom: none;
            position: relative;
        }

        .card-header::before { /* Subtle diagonal pattern */
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(45deg, rgba(255,255,255,0.1) 25%, transparent 25%, transparent 50%, rgba(255,255,255,0.1) 50%, rgba(255,255,255,0.1) 75%, transparent 75%, transparent);
            background-size: 15px 15px;
            opacity: 0.1;
        }

        .card-header h5 {
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
            background-color: #fdfefe; /* Very light background */
        }

        /* Message bubbles */
        .card-body > div {
            margin-bottom: 1rem;
        }

        /* Received messages */
        .bg-light {
            background-color: #e9ecef !important; /* Light grey for received messages */
            border-radius: 0.5rem 1.2rem 1.2rem 1.2rem;
            max-width: 70%;
            word-wrap: break-word;
            position: relative;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Sent messages (original bg-primary) */
        .bg-primary {
            background-color: #28a745 !important; /* A vibrant green for sent messages */
            border-radius: 1.2rem 0.5rem 1.2rem 1.2rem;
            color: white;
            max-width: 70%;
            word-wrap: break-word;
            position: relative;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Override for sent messages specifically when using text-end */
        .text-end .bg-primary {
            background-color: #6c757d !important; /* A softer dark grey for sent messages */
            border-radius: 1.2rem 0.5rem 1.2rem 1.2rem;
        }

        .rounded-circle {
            border: 2px solid #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card-footer {
            background-color: #ffffff;
            border-top: 1px solid #f0f0f0;
            padding: 1rem 1.5rem;
        }

        .input-group .form-control {
            border-radius: 50px; /* Pill-shaped input */
            border-color: #ced4da;
            padding: 0.7rem 1.2rem;
            font-size: 0.95rem;
        }

        .input-group .form-control:focus {
            border-color: #8e44ad;
            box-shadow: 0 0 0 0.25rem rgba(142, 68, 173, 0.25);
        }

        .input-group .btn-primary {
            border-radius: 50px;
            background-color: #8e44ad;
            border-color: #8e44ad;
            padding: 0.7rem 1.5rem;
            font-weight: 500;
        }

        .input-group .btn-primary:hover {
            background-color: #7d3c98;
            border-color: #7d3c98;
        }

        .btn-light {
            border-radius: 20px;
            font-weight: 500;
            color: #ffffff; /* Make text white for better contrast against purple header */
            background-color: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .btn-light:hover {
            background-color: rgba(255, 255, 255, 0.4);
            border-color: rgba(255, 255, 255, 0.5);
            color: #ffffff;
        }

        .text-muted {
            font-size: 0.75rem;
            opacity: 0.8;
        }

        /* Custom Scrollbar for chat-messages */
        #chat-messages::-webkit-scrollbar {
            width: 8px;
        }

        #chat-messages::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        #chat-messages::-webkit-scrollbar-thumb {
            background: #bbb; /* Lighter gray */
            border-radius: 10px;
        }

        #chat-messages::-webkit-scrollbar-thumb:hover {
            background: #999;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Chat with {{ $chalet->name }}</h5>
                    <a href="{{ route('showingAllChalets') }}" class="btn btn-light btn-sm">
                        <i class="fa fa-arrow-left me-1"></i> Back
                    </a>
                </div>

                <div class="card-body" style="height: 400px; overflow-y: auto;" id="chat-messages">
                    {{-- Messages will appear here via JavaScript --}}
                    @foreach($messages as $message)
                    <div class="mb-3 {{ $message->sender_id == auth()->id() ? 'text-end' : 'text-start' }}">
                        <div class="d-flex align-items-center {{ $message->sender_id == auth()->id() ? 'justify-content-end' : '' }}">
                            @if($message->sender_id != auth()->id())
                            <img src="{{ asset('img/user-icon.png') }}" alt="User" class="rounded-circle me-2" width="30">
                            @endif
                            <div class="{{ $message->sender_id == auth()->id() ? 'bg-primary text-white' : 'bg-light' }} rounded p-3">
                                {{ $message->message }}
                            </div>
                            @if($message->sender_id == auth()->id())
                            <img src="{{ asset('img/user-icon.png') }}" alt="You" class="rounded-circle ms-2" width="30">
                            @endif
                        </div>
                        <small class="text-muted d-block mt-1 {{ $message->sender_id == auth()->id() ? 'text-end' : '' }}">
                            {{ $message->created_at->diffForHumans() }}
                        </small>
                    </div>
                    @endforeach
                </div>

                <div class="card-footer">
                    <form id="message-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="message" id="message-input" class="form-control" placeholder="Type your message here..." autocomplete="off">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-paper-plane"></i> Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // تهيئة Pusher
    const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        encrypted: true
    });

    // الاشتراك في القناة الخاصة بالمحادثة
    const channel = pusher.subscribe('chat.{{ $chat->id }}');

    // الاستماع لحدث NewMessage
    channel.bind('NewMessage', function(data) {
        // إضافة الرسالة الجديدة للواجهة
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('mb-3');

        if(data.sender.id == {{ auth()->id() }}) {
            messageDiv.classList.add('text-end');
            messageDiv.innerHTML = `
                <div class="d-flex align-items-center justify-content-end">
                    <div class="bg-primary text-white rounded p-3">
                        ${data.message}
                    </div>
                    <img src="{{ asset('img/user-icon.png') }}" alt="You" class="rounded-circle ms-2" width="30">
                </div>
                <small class="text-muted d-block mt-1 text-end">
                    الآن
                </small>
            `;
        } else {
            messageDiv.classList.add('text-start');
            messageDiv.innerHTML = `
                <div class="d-flex align-items-center">
                    <img src="{{ asset('img/user-icon.png') }}" alt="User" class="rounded-circle me-2" width="30">
                    <div class="bg-light rounded p-3">
                        ${data.message}
                    </div>
                </div>
                <small class="text-muted d-block mt-1">
                    الآن
                </small>
            `;
        }

        document.getElementById('chat-messages').appendChild(messageDiv);

        // التمرير لأسفل
        document.getElementById('chat-messages').scrollTop = document.getElementById('chat-messages').scrollHeight;
    });

    // إرسال الرسالة عبر AJAX
    document.getElementById('message-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const messageInput = document.getElementById('message-input');
        const message = messageInput.value.trim();

        if(message) {
            axios.post('{{ route('chat.send', $chat) }}', {
                message: message
            }).then(response => {
                messageInput.value = '';
            }).catch(error => {
                console.error(error);
            });
        }
    });

    // التمرير لأسفل عند تحميل الصفحة
    window.onload = function() {
        const chatMessages = document.getElementById('chat-messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
    };
</script>

</body>
</html>