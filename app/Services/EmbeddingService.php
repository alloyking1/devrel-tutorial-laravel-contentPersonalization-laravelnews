<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
class EmbeddingService
{
    public function generate(string $text): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('HUGGINGFACE_API_KEY'),
        ])->post(env('HUGGINGFACE_API_URL'), [
            'inputs' => $text,
        ]);
        return $response->json();
    }
}