<x-app-layout>
    <x-slot name="header">
        Return Books
    </x-slot>

    <div class="max-w-4xl mx-auto">

        <div class="bg-white shadow rounded-lg p-6">

            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800">
                    Borrow Details
                </h2>

                <div class="mt-3 text-sm text-gray-600 space-y-1">
                    <p><strong>Student:</strong> {{ $borrow->student->name }}</p>
                    <p><strong>Borrow Date:</strong> {{ $borrow->borrow_date->format('M d, Y') }}</p>
                    <p><strong>Due Date:</strong> {{ $borrow->due_date->format('M d, Y') }}</p>
                </div>
            </div>

            <form action="{{ route('borrows.return', $borrow) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Select Books to Return
                    </label>

                    <div class="space-y-3">
                        @foreach($borrow->borrowItems as $item)
                            <div class="flex items-center justify-between border rounded-lg p-3">

                                <div>
                                    <p class="font-medium text-gray-800">
                                        {{ $item->book->title }}
                                    </p>

                                    @if($item->status === 'returned')
                                        <p class="text-green-600 text-sm">
                                            Already returned
                                        </p>
                                    @else
                                        @php
                                            $comparisonDate = $item->status === 'returned' ? $item->return_date : now();
                                            $overdueDays = Carbon\Carbon::parse($comparisonDate)->greaterThan($borrow->due_date)
                                                ? Carbon\Carbon::parse($comparisonDate)->diffInDays($borrow->due_date)
                                                : 0;
                                            $fine = $overdueDays * 10;
                                        @endphp

                                        @if($overdueDays > 0)
                                            <p class="text-red-500 text-sm">
                                                Overdue: {{ $overdueDays }} days | Fine: ₱{{ $fine }}
                                            </p>
                                        @elseif($item->status === 'returned')
                                            <p class="text-green-600 text-sm">Returned | No Fine</p>
                                        @else
                                            <p class="text-gray-500 text-sm">No fine</p>
                                        @endif
                                    @endif
                                </div>

                                @if($item->status !== 'returned')
                                    <input type="checkbox"
                                           name="borrow_items[]"
                                           value="{{ $item->id }}"
                                           class="h-5 w-5 text-indigo-600">
                                @endif

                            </div>
                        @endforeach
                    </div>

                    @error('borrow_items')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Return Date
                    </label>
                    <input type="date"
                           name="return_date"
                           value="{{ now()->toDateString() }}"
                           class="w-full border rounded-lg px-3 py-2">
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('borrows.index') }}"
                       class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">
                        Cancel
                    </a>

                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                        Process Return
                    </button>
                </div>

            </form>

        </div>

    </div>
</x-app-layout>