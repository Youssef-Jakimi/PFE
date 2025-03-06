<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with GPT-4o Mini</title>
    <style>
        /* Simple chat-like styling */
        .chat-container {
            width: 60%;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            max-height: 400px;
            overflow-y: scroll;
        }
        .message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .user {
            background-color: #f1f1f1;
            text-align: right;
        }
        .assistant {
            background-color: #e0f7fa;
            text-align: left;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h1>Chat with GPT-4o Mini</h1>

<!-- Chat Container -->
<div class="chat-container">
    @foreach ($chatHistory as $message)
        <div class="message @if ($message['role'] === 'user') user @else assistant @endif">
            <strong>{{ $message['role'] === 'user' ? 'You' : 'GPT-4o Mini' }}:</strong>
            <p>{{ $message['content'] }}</p>
        </div>
    @endforeach
</div>

<!-- Chat Form -->
<form action="{{ route('gpt.response') }}" method="POST">
    @csrf
    <input type="text" name="query" placeholder="Ask a question..." required>
    <button type="submit">Send</button>
</form>

</body>
</html>
