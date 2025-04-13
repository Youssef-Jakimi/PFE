<?php

namespace App\Services;

use Log;
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

    // GPTService
    public function generateResponse($chatHistory)
    {
        $messages = [];
        
        $messages[] = [
            'role' => 'system',
            'content' => "Vous êtes un assistant conçu pour aider les utilisateurs dans ses réservation des chambres qui sont principalment dans /chambre , des tables dans notre restaurant qui sont principalment dans /table ou une séance de spa qui sont principalment dans /spa et c'est tout dans notre un hôtel, si un utilisateur te questionne a propos de quel que n'est lié a aucune de ses trois tu me repond par (Désolé, je ne peux vous aider que pour les réservations des services de notre hôtel. Puis-je vous aider à réserver une chambre d'hôtel ?..."
        ];
    
        foreach ($chatHistory as $message) {
            $messages[] = [
                'role' => $message['role'],
                'content' => $message['content'],
            ];
        }
    
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post($this->apiUrl, [
                'model' => 'ft:gpt-4o-2024-08-06:jkgamer::BLvQejSo',
                'messages' => $messages,
                'max_tokens' => 150,
            ]);
    
            // Log the response for debugging
            \Log::info('GPT API Response:', ['response' => $response->json()]);
    
            if ($response->successful()) {
                return $response->json()['choices'][0]['message']['content'];
            }
    
            // Log any API errors
            Log::error('Error with GPT API:', ['status' => $response->status(), 'error' => $response->json()['error']]);
            
            return 'Error: ' . $response->status() . ' - ' . $response->json()['error']['message'];
        } catch (\Exception $e) {
            \Log::error('Exception while making GPT API request:', ['error' => $e->getMessage()]);
            return 'Error: Could not process the request.';
        }
    }
    

}
