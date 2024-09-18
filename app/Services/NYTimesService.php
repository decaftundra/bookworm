<?php

  namespace App\Services;

  use Illuminate\Support\Facades\Http;

  class NYTimesService
  {
    public static function fetchBestSellers()
    {
      $apiKey = config('services.nytimes.key');
      $response = Http::get(
        "https://api.nytimes.com/svc/books/v3/lists/current/hardcover-fiction.json?api-key=$apiKey",
      );
      return $response->json()['results']['books'];
    }

    public static function searchBooks($query): array
    {
      $apiKey = config('services.nytimes.key');
      $allBooks = [];
      $offset = 0;
      $limit = 20;

      do {
        $response = Http::get(
          "https://api.nytimes.com/svc/books/v3/lists/best-sellers/history.json?api-key=$apiKey&title=$query&offset=$offset",
        );
        $data = $response->json();

        if (isset($data['results'])) {
          $books = $data['results'];
          $allBooks = array_merge($allBooks, $books);
          $offset += $limit;
        } else {
          break;
        }
      } while (count($books) === $limit);

      return $allBooks;
    }
  }
