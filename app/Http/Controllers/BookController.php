<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        return Auth::user()->books;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'rating' => 'required|integer|min:0|max:5',
            'price' => 'required|numeric',
        ]);
        $book = Auth::user()->books()->create($validatedData);
        return response()->json($book, 201);
    }

    public function show($id)
    {
        $book = Auth::user()->books()->findOrFail($id);
        return response()->json($book);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'sometimes|string|max:255',
            'author' => 'sometimes|string|max:255',
            'rating' => 'sometimes|integer|min:0|max:5',
            'price' => 'sometimes|numeric',
        ]);
        $book = Auth::user()->books()->findOrFail($id);
        $book->update($validatedData);
        return response()->json($book, 200);
    }

    public function destroy($id)
    {
        $book = Auth::user()->books()->findOrFail($id);
        $book->delete();
        return response()->json(null, 204);
    }
}
