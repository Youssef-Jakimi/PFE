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

    // GET route to show the form
    public function showForm()
    {
        return view('gpt.form');  // Render the initial chat form
    }

    // POST route to process user message and get GPT response
    // GPTController
        public function getResponse(Request $request)
        {
            // Get the entire chat history from the request
            $chatHistory = $request->input('chatHistory');

            // Get GPT's response via the service class
            $gptResponse = $this->gptService->generateResponse($chatHistory);

            // Return the response as JSON to send it back to the frontend
            return response()->json(['response' => $gptResponse]);
        }

}


