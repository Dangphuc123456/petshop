<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('openai.api_key');
        $this->baseUrl = config('openai.base_url');
    }

    // Hàm gọi API OpenAI
    public function chat($messages)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])
        ->post($this->baseUrl . 'chat/completions', [
            'model' => config('openai.default_model'),
            'messages' => $messages,
            'temperature' => 0.6,
            'max_tokens' => 200,
        ]);

        return $response->json();
    }
}
