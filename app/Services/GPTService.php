<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GPTService
{
    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
        $this->apiUrl = env('OPENAI_API_URL');

    }

    public function generateResponse($userInput)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl, [
            'model' => 'ft:gpt-4o-mini-2024-07-18:jkgamer::BBktcytg',  // Specify the model (GPT-4o Mini)
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => $userInput],
            ],
            'max_tokens' => 150,
        ]);

        // Return the generated content if successful
        if ($response->successful()) {
            return $response->json()['choices'][0]['message']['content'];
        }

        // Return error message if the request fails
        return 'Error: ' . $response->status() . ' - ' . $response->json()['error']['message'];
    }
}
