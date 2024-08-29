<?php

  namespace App\Http\Controllers;

  use App\Services\NYTimesService;
  use Illuminate\Http\Request;
  use Inertia\Inertia;

  class NYTimesController extends Controller
  {
    private function renderBestsellers(array $books)
    {
      return Inertia::render('  ', [
        'books' => $books,
      ]);
    }

    public function fetchBestSellers()
    {
      $books = NYTimesService::fetchBestSellers();
      return $this->renderBestsellers($books);
    }

    public function searchBooks(Request $request)
    {
      $query = $request->query('q');
      $books = NYTimesService::searchBooks($query);
      return $this->renderBestsellers($books);
    }
  }
