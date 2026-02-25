<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowItem extends Model
{
    /** @use HasFactory<\Database\Factories\BorrowItemFactory> */
    use HasFactory;

    protected $fillable = [
        'borrow_id',
        'book_id',
        'status',
        'return_date',
        'fine_amount',
    ];

    public function borrow()
    {
        return $this->belongsTo(Borrow::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
