<?php

namespace App\Http\Controllers;

use App\Services\NYTimesService;
use Illuminate\Http\Request;

class NYTimesController extends Controller
{
    public function fetchBestSellers()
    {
        $books = NYTimesService::fetchBestSellers();
        return response()->json($books);
    }

    public function searchBooks(Request $request)
    {
        $query = $request->query('q');
        $books = NYTimesService::searchBooks($query);
        return response()->json($books);
    }
}
