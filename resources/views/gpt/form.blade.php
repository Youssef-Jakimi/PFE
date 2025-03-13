=<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat with GPT-4o Mini</title>
    <style>
        /* CSS Variables */
        :root {
            --primary-color: #b8860b;
            --secondary-color: #2c3e50;
            --accent-color: #d4af37;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --background-color: #f0efe7;
            --text-color: #333;
            --transition-speed: 0.3s;
            --shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Global Styles */
        body {
            background-color: var(--background-color);
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h1 {
            text-align: center;
            color: var(--secondary-color);
            font-size: 2rem;
            margin-bottom: 1.5rem;
            animation: fadeIn 1s ease-in-out;
        }

        /* Main Container */
        .main-container {
            width: 100%;
            max-width: 900px;
            padding: 2rem;
            background: linear-gradient(135deg, var(--light-color), #fff);
            border-radius: 12px;
            box-shadow: var(--shadow);
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
        }

        /* Chat Container */
        .chat-container {
            max-height: 450px;
            overflow-y: auto;
            padding: 1.5rem;
            background-color: #fff;
            border-radius: 8px;
            border: 1px solid var(--secondary-color);
            margin-bottom: 1.5rem;
            transition: all var(--transition-speed) ease;
        }

        /* Message Styles */
        .message {
            display: flex;
            flex-direction: column;
            margin: 1rem 0;
            padding: 1rem;
            border-radius: 10px;
            max-width: 75%;
            word-wrap: break-word;
            animation: fadeIn 0.4s ease-in;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .user {
            background: linear-gradient(45deg, var(--primary-color), #d4a017);
            color: white;
            align-self: flex-end;
        }

        .assistant {
            background: linear-gradient(45deg, var(--accent-color), #e6c34a);
            color: white;
            align-self: flex-start;
        }

        .message strong {
            font-size: 0.9rem;
            margin-bottom: 0.4rem;
        }

        .message p {
            margin: 0;
            font-size: 1rem;
        }

        /* Typing Indicator */
        .typing {
            display: flex;
            align-items: center;
            color: var(--text-color);
            font-style: italic;
            animation: fadeIn 0.3s ease-in;
        }

        .typing::after {
            content: 'Typing...';
            animation: blink 1s infinite;
        }

        /* Input Form */
        .chat-form {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        input[type="text"] {
            flex: 1;
            padding: 0.9rem;
            border: 1px solid var(--secondary-color);
            border-radius: 6px;
            font-family: 'Montserrat', sans-serif;
            color: var(--text-color);
            background-color: white;
            transition: all var(--transition-speed) ease;
        }

        input[type="text"]:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 8px rgba(184, 134, 11, 0.3);
        }

        /* Button Styles */
        button {
            padding: 0.9rem 2rem;
            background: linear-gradient(45deg, var(--primary-color), #d4a017);
            color: white;
            border: none;
            border-radius: 6px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
        }

        button:hover {
            background: linear-gradient(45deg, var(--accent-color), #e6c34a);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Scrollbar Customization */
        .chat-container::-webkit-scrollbar {
            width: 8px;
        }

        .chat-container::-webkit-scrollbar-thumb {
            background-color: var(--primary-color);
            border-radius: 4px;
        }

        .chat-container::-webkit-scrollbar-track {
            background-color: var(--light-color);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes blink {
            50% { opacity: 0.5; }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-container {
                width: 95%;
                padding: 1.5rem;
            }

            h1 {
                font-size: 1.6rem;
            }

            .chat-container {
                max-height: 350px;
            }

            .chat-form {
                flex-direction: column;
                gap: 1rem;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <h1>Chat with GPT-4o Mini</h1>
        <!-- Chat Container -->
        <div class="chat-container" id="chat-container">
            <!-- Messages will be appended here -->
        </div>
        <!-- Chat Form -->
        <form id="chat-form" class="chat-form">
            <input type="text" id="user-input" placeholder="Ask a question..." required>
            <button type="submit">Send</button>
        </form>
    </div>

    <script>
        // Clear chat history on page refresh
        sessionStorage.removeItem('chatHistory');

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

            // Show typing indicator
            const chatContainer = document.getElementById('chat-container');
            const typingDiv = document.createElement('div');
            typingDiv.classList.add('message', 'assistant', 'typing');
            chatContainer.appendChild(typingDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;

            // Send the message to the backend (GPT)
            const response = await fetch("{{ route('gpt.response') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content // Include CSRF token for security
                },
                body: JSON.stringify({ query: userInput })
            });

            // Remove typing indicator
            typingDiv.remove();

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
