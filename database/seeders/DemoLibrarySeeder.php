<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\BorrowItem;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoLibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /*
        |--------------------------------------------------------------------------
        | STUDENTS
        |--------------------------------------------------------------------------
        */

        $student1 = Student::create([
            'name' => 'Nick Melloria',
            'student_number' => '2301106533',
            'contact' => '09123456789'
        ]);

        $student2 = Student::create([
            'name' => 'Zoid Balba',
            'student_number' => '2301106534',
            'contact' => '09876543210'
        ]);


        /*
        |--------------------------------------------------------------------------
        | AUTHORS
        |--------------------------------------------------------------------------
        */

        $author1 = Author::create([
            'name' => 'Jose Rizal'
        ]);

        $author2 = Author::create([
            'name' => 'George Orwell'
        ]);

        $author3 = Author::create([
            'name' => 'Harper Lee'
        ]);


        /*
        |--------------------------------------------------------------------------
        | BOOKS
        |--------------------------------------------------------------------------
        */

        $book1 = Book::create([
            'title' => 'Noli Me Tangere',
            'total_copies' => 5,
            'available_copies' => 5
        ]);
        $book1->authors()->sync([$author1->id]);

        $book2 = Book::create([
            'title' => '1984',
            'total_copies' => 5,
            'available_copies' => 5
        ]);
        $book2->authors()->sync([$author2->id]);

        $book3 = Book::create([
            'title' => 'To Kill a Mockingbird',
            'total_copies' => 5,
            'available_copies' => 5
        ]);
        $book3->authors()->sync([$author3->id]);


        /*
        |--------------------------------------------------------------------------
        | BORROW 1 - RETURNED (NO FINE)
        |--------------------------------------------------------------------------
        */

        $borrow1 = Borrow::create([
            'student_id' => $student1->id,
            'borrow_date' => Carbon::today()->subDays(7),
            'due_date' => Carbon::today()->subDays(3),
            'status' => 'returned'
        ]);

        BorrowItem::create([
            'borrow_id' => $borrow1->id,
            'book_id' => $book1->id,
            'status' => 'returned',
            'return_date' => Carbon::today()->subDays(4),
            'fine_amount' => 0
        ]);

        BorrowItem::create([
            'borrow_id' => $borrow1->id,
            'book_id' => $book2->id,
            'status' => 'returned',
            'return_date' => Carbon::today()->subDays(4),
            'fine_amount' => 0
        ]);

        /*
        |--------------------------------------------------------------------------
        | BORROW 2 - RETURNED (WITH FINE)
        |--------------------------------------------------------------------------
        */

        $borrow2 = Borrow::create([
            'student_id' => $student2->id,
            'borrow_date' => Carbon::today()->subDays(10),
            'due_date' => Carbon::today()->subDays(5),
            'status' => 'returned'
        ]);

        BorrowItem::create([
            'borrow_id' => $borrow2->id,
            'book_id' => $book2->id,
            'status' => 'returned',
            'return_date' => Carbon::today()->subDays(2), // late
            'fine_amount' => 30 // 3 days late × ₱10
        ]);


        /*
        |--------------------------------------------------------------------------
        | BORROW 3 - ACTIVE (NOT OVERDUE)
        |--------------------------------------------------------------------------
        */

        $borrow3 = Borrow::create([
            'student_id' => $student1->id,
            'borrow_date' => Carbon::today()->subDays(1),
            'due_date' => Carbon::today()->addDays(3),
            'status' => 'active'
        ]);

        BorrowItem::create([
            'borrow_id' => $borrow3->id,
            'book_id' => $book3->id,
            'status' => 'borrowed'
        ]);
        $book3->decrement('available_copies');


        /*
        |--------------------------------------------------------------------------
        | BORROW 4 - ACTIVE (OVERDUE)
        |--------------------------------------------------------------------------
        */

        $borrow4 = Borrow::create([
            'student_id' => $student2->id,
            'borrow_date' => Carbon::today()->subDays(8),
            'due_date' => Carbon::today()->subDays(2),
            'status' => 'active'
        ]);

        BorrowItem::create([
            'borrow_id' => $borrow4->id,
            'book_id' => $book1->id,
            'status' => 'borrowed'
        ]);
        $book1->decrement('available_copies');
    }
}
