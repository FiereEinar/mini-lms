<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('authors')->latest()->paginate(10);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();

        return view('books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total_copies' => 'required|integer|min:1',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
        ]);

        $book = Book::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'total_copies' => $validated['total_copies'],
            'available_copies' => $validated['total_copies'], // initially all available
        ]);

        $book->authors()->sync($validated['authors']);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        $bookAuthors = $book->authors->pluck('id')->toArray();

        return view('books.edit', compact('book', 'authors', 'bookAuthors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total_copies' => 'required|integer|min:1',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
        ]);

        // Adjust available copies if total_copies changes
        $diff = $validated['total_copies'] - $book->total_copies;
        $book->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'total_copies' => $validated['total_copies'],
            'available_copies' => $book->available_copies + $diff,
        ]);

        $book->authors()->sync($validated['authors']);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->authors()->detach();
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
