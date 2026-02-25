<?php

namespace App\Http\Controllers;

use App\Models\BorrowItem;
use App\Http\Requests\StoreBorrowItemRequest;
use App\Http\Requests\UpdateBorrowItemRequest;

class BorrowItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBorrowItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BorrowItem $borrowItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BorrowItem $borrowItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBorrowItemRequest $request, BorrowItem $borrowItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BorrowItem $borrowItem)
    {
        //
    }
}
