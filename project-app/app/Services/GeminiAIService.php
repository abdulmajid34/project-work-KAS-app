<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiAIService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
        $this->baseUrl = config('services.gemini.base_url');
    }

    public function analyzeText($input)
    {

        $url = $this->baseUrl . ':generateContent' . '?key=' . $this->apiKey;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url, [
            'contents' => [
                'parts' => [
                    ['text' => $input]
                ]
            ]
        ]);

        // if ($response->successful()) {
        //     return $response->json();
        // }

        if ($response->successful()) {
            $data = $response->json();
            // Extract the text content from Gemini's response structure
            return $data['candidates'][0]['content']['parts'][0]['text'] ?? 'No response generated';
        }

        throw new \Exception('Gemini AI request failed: ' . $response->body());
    }
}
