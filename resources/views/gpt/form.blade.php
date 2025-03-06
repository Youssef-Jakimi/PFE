<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat with GPT-4o Mini</title>
    <style>
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
<div class="chat-container" id="chat-container">
    <!-- Messages will be appended here -->
</div>

<!-- Chat Form -->
<form id="chat-form">
    <input type="text" id="user-input" placeholder="Ask a question..." required>
    <button type="submit">Send</button>
</form>

<script>
    // Clear chat history on page refresh
    sessionStorage.removeItem('chatHistory');  // This will clear the session storage

    // Retrieve chat history from sessionStorage if it exists
    let chatHistory = JSON.parse(sessionStorage.getItem('chatHistory')) || [];

    // Function to render chat messages
    function renderChat() {
        const chatContainer = document.getElementById('chat-container');
        chatContainer.innerHTML = ''; // Clear current chat history

        // Append all messages from chatHistory to the chat container
        chatHistory.forEach((message) => {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('message', message.role);
            messageDiv.innerHTML = `<strong>${message.role === 'user' ? 'You' : 'GPT-4o Mini'}:</strong><p>${message.content}</p>`;
            chatContainer.appendChild(messageDiv);
        });

        // Scroll to the bottom of the chat container
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    // Event listener for form submission
    document.getElementById('chat-form').addEventListener('submit', async function(event) {
        event.preventDefault();

        const userInput = document.getElementById('user-input').value;
        
        // Add the user's message to the chat history
        chatHistory.push({ role: 'user', content: userInput });
        sessionStorage.setItem('chatHistory', JSON.stringify(chatHistory)); // Save to sessionStorage
        
        // Render the updated chat history
        renderChat();

        // Clear the input field
        document.getElementById('user-input').value = '';

        // Send the message to the backend (GPT)
        const response = await fetch("{{ route('gpt.response') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content // Include CSRF token for security
            },
            body: JSON.stringify({ query: userInput })
        });

        if (!response.ok) {
            console.error('Failed to send request to the API');
            return;
        }

        const data = await response.json();
        
        // Add GPT's response to the chat history
        chatHistory.push({ role: 'assistant', content: data.response });
        sessionStorage.setItem('chatHistory', JSON.stringify(chatHistory)); // Save to sessionStorage
        
        // Render the updated chat history with the new response
        renderChat();
    });

    // Initial render of chat history when the page loads
    renderChat();
</script>

</body>
</html>
