<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NYTimesService
{
    public static function fetchBestSellers()
    {
        $apiKey = config('services.nytimes.key');
        $response = Http::get("https://api.nytimes.com/svc/books/v3/lists/current/hardcover-fiction.json?api-key={$apiKey}");
        return $response->json()['results']['books'];
    }

    public static function searchBooks($query)
    {
        $apiKey = config('services.nytimes.key');
        $response = Http::get("https://api.nytimes.com/svc/books/v3/reviews.json?title={$query}&api-key={$apiKey}");
        return $response->json()['results'];
    }
}
