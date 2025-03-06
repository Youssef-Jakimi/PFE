<?php
namespace App\Http\Controllers;

use App\Services\GPTService;
use Illuminate\Http\Request;

class GPTController extends Controller
{
    protected $gptService;

    public function __construct(GPTService $gptService)
    {
        $this->gptService = $gptService;
    }

    public function showForm()
    {
        // Initialize the chat history as an empty array
        $chatHistory = session('chat_history', []);
        return view('gpt.form', ['chatHistory' => $chatHistory]);
    }

    public function getResponse(Request $request)
    {
        $userInput = $request->input('query');

        // Retrieve the chat history stored in the session
        $chatHistory = session('chat_history', []);

        // Add the user query to the chat history
        $chatHistory[] = ['role' => 'user', 'content' => $userInput];

        // Get GPT response
        $gptResponse = $this->gptService->generateResponse($userInput);

        // Add GPT's response to the chat history
        $chatHistory[] = ['role' => 'assistant', 'content' => $gptResponse];

        // Store the updated chat history back to the session
        session(['chat_history' => $chatHistory]);

        return view('gpt.form', ['chatHistory' => $chatHistory]);
    }
}

