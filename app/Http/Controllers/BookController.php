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
        $book = Auth::user()->books()->create($request->all());
        return response()->json($book, 201);
    }

    public function show($id)
    {
        $book = Auth::user()->books()->findOrFail($id);
        return response()->json($book);
    }

    public function update(Request $request, $id)
    {
        $book = Auth::user()->books()->findOrFail($id);
        $book->update($request->all());
        return response()->json($book, 200);
    }

    public function destroy($id)
    {
        $book = Auth::user()->books()->findOrFail($id);
        $book->delete();
        return response()->json(null, 204);
    }
}
