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
            'model' => 'ft:gpt-4o-mini-2024-07-18:jkgamer::BJTYRWJm',  // Specify the model (GPT-4o Mini)
            'messages' => [
                ['role' => 'system', 'content' => "Vous êtes un assistant conçu pour aider les utilisateurs dans ses réservation des chambres, des tables dans notre restaurant ou une séance de spa tout dans notre un hôtel. Veuillez fournir uniquement des informations relatives aux réservations des chambres, des tables dans notre restaurant ou des seances de spa dans notre hôtel, à la disponibilité des chambres, aux heures d'arrivée et de départ et aux services. Si un utilisateur pose une question sur des sujets autres que les réservations des chambres, des tables dans notre restaurant ou des seances de spa dans notre hôtel, répondez : Désolé, je ne peux vous aider que pour les réservations des services de notre hôtel. Puis-je vous aider à réserver une chambre d'hôtel ?"],
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
