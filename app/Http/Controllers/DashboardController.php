<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\BorrowItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::sum('total_copies');
        $availableBooks = Book::sum('available_copies');
        $activeBorrows = Borrow::where('status', 'active')->count();
        $overdueBorrows = Borrow::where('status', 'active')
            ->whereDate('due_date', '<', now())
            ->count();
        $totalFines = BorrowItem::where('status', 'returned')->sum('fine_amount');

        // Borrows trend last 7 days
        $borrowsTrend = Borrow::select(
                DB::raw('DATE(borrow_date) as date'),
                DB::raw('count(*) as total')
            )
            ->where('borrow_date', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date')
            ->toArray();

        // Ensure all 7 days are present
        $dates = collect(range(0,6))->map(function($i){
            return now()->subDays(6 - $i)->format('Y-m-d');
        });

        $borrowsTrendFull = $dates->map(fn($date) => $borrowsTrend[$date] ?? 0);

        return view('dashboard', compact(
            'totalBooks',
            'availableBooks',
            'activeBorrows',
            'overdueBorrows',
            'totalFines',
            'dates',
            'borrowsTrendFull'
        ));
    }
}
