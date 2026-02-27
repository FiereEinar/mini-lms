<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Http\Requests\StoreBorrowRequest;
use App\Http\Requests\UpdateBorrowRequest;
use App\Models\Book;
use App\Models\BorrowItem;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrows = Borrow::with('student', 'borrowItems.book')->latest()->paginate(10);

        return view('borrows.index', compact('borrows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        $books = Book::where('available_copies', '>', 0)->get();

        return view('borrows.create', compact('students', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBorrowRequest $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'books' => 'required|array',
            'books.*' => 'exists:books,id',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        $borrow = Borrow::create([
            'student_id' => $validated['student_id'],
            'borrow_date' => Carbon::today(),
            'due_date' => $validated['due_date'],
            'status' => 'active',
        ]);

        foreach ($validated['books'] as $bookId) {
            $book = Book::find($bookId);
            if ($book->available_copies > 0) {
                BorrowItem::create([
                    'borrow_id' => $borrow->id,
                    'book_id' => $book->id,
                    'status' => 'borrowed',
                ]);
                $book->decrement('available_copies');
            }
        }

        return redirect()->route('borrows.index')->with('success', 'Borrow record created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrow $borrow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrow $borrow)
    {
        $borrow->load('student', 'borrowItems.book');

        return view('borrows.return', compact('borrow'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBorrowRequest $request, Borrow $borrow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrow $borrow)
    {
        //
    }

    public function returnBook(Request $request, Borrow $borrow)
    {
        $validated = $request->validate([
            'borrow_items' => 'required|array',
            'borrow_items.*' => 'exists:borrow_items,id',
            'return_date' => 'nullable|date',
        ]);

        // Normalize return date (remove time component)
        $returnDate = isset($validated['return_date'])
            ? Carbon::parse($validated['return_date'])->startOfDay()
            : now()->startOfDay();

        DB::transaction(function () use ($validated, $borrow, $returnDate) {

            foreach ($validated['borrow_items'] as $itemId) {

                // Ensure item belongs to this borrow
                $item = $borrow->borrowItems()->where('id', $itemId)->firstOrFail();

                if ($item->status === 'returned') {
                    continue;
                }

                // Normalize due date
                $dueDate = $borrow->due_date->copy()->startOfDay();

                $overdueDays = 0;
                $fine = 0;

                if ($returnDate->gt($dueDate)) {
                    $overdueDays = $dueDate->diffInDays($returnDate);
                    $fine = $overdueDays * 10;
                }

                $item->update([
                    'status' => 'returned',
                    'return_date' => $returnDate,
                    'fine_amount' => $fine,
                ]);

                // Update inventory
                $item->book()->increment('available_copies');
            }

            // If all items are returned → mark borrow returned
            if ($borrow->borrowItems()->where('status', 'borrowed')->count() === 0) {
                $borrow->update(['status' => 'returned']);
            }
        });

        return redirect()
            ->route('borrows.index')
            ->with('success', 'Books returned successfully.');
    }
}
