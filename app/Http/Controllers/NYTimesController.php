<?php

namespace App\Http\Controllers;

use App\Services\NYTimesService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NYTimesController extends Controller
{
    public function fetchBestSellers()
    {
        $books = NYTimesService::fetchBestSellers();
        return Inertia::render('NYT/Bestsellers', [
            'books' => $books,
        ]);
    }

    public function searchBooks(Request $request)
    {
        $query = $request->query('q');
        $books = NYTimesService::searchBooks($query);
        return Inertia::render('NYT/Bestsellers', [
            'books' => $books,
        ]);
    }
}
