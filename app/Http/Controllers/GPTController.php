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
    public function getResponse(Request $request)
    {
        // Get the user's message from the request
        $userInput = $request->input('query');

        // Get GPT's response via the service class
        $gptResponse = $this->gptService->generateResponse($userInput);

        // Return response as JSON to send it back to the frontend
        return response()->json(['response' => $gptResponse]);
    }
}


