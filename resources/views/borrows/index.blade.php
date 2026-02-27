<x-app-layout>
    <x-slot name="header">Borrow Records</x-slot>

    <div>

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Borrow Records</h2>
            <a href="{{ route('borrows.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow">
                + New Borrow
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-100 text-xs uppercase tracking-wider text-gray-700">
                    <tr>
                        <th class="px-6 py-3">Student</th>
                        <th class="px-6 py-3">Books & Status</th>
                        <th class="px-6 py-3">Borrow Date</th>
                        <th class="px-6 py-3">Due Date</th>
                        <th class="px-6 py-3">Total Fine</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($borrows as $borrow)
                        @php
                            $totalFine = 0;

                            foreach ($borrow->borrowItems as $item) {
                                if ($item->status === 'returned') {
                                    $totalFine += (int) $item->fine_amount;
                                } else {
                                    $today = \Carbon\Carbon::today();
                                    $dueDate = \Carbon\Carbon::parse($borrow->due_date);

                                    if ($today->greaterThan($dueDate)) {
                                        $daysLate = $today->diffInDays($dueDate);
                                        $totalFine += $daysLate * 10;
                                    }
                                }
                            }

                            $totalFine = $totalFine * -1;
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">{{ $borrow->student->name }}</td>
                            <td class="px-6 py-4">
                                <ul class="space-y-1">
                                    @foreach($borrow->borrowItems as $item)
                                        <li class="flex justify-between">
                                            <span>{{ $item->book->title }}</span>
                                            <span class="text-xs 
                                                @if($item->status === 'returned') text-green-600 
                                                @elseif($item->return_date ?? now() > $borrow->due_date) text-red-500 
                                                @else text-gray-500 
                                                @endif">
                                                {{ ucfirst($item->status) }}
                                                @if($item->status === 'returned' && $item->fine_amount > 0)
                                                    | ₱{{ $item->fine_amount }}
                                                @elseif($item->status === 'borrowed')
                                                    @php
                                                        $today = \Carbon\Carbon::today();
                                                        $dueDate = \Carbon\Carbon::parse($borrow->due_date);
                                                        $fine = 0;

                                                        if ($today->greaterThan($dueDate)) {
                                                            $daysLate = $today->diffInDays($dueDate);
                                                            $fine = $daysLate * 10;
                                                        }
                                                    @endphp

                                                    @if($fine > 0)
                                                        | ₱{{ $fine }}
                                                    @endif
                                                @endif
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($borrow->borrow_date)->format('M d, Y') }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($borrow->due_date)->format('M d, Y') }}</td>
                            <td class="px-6 py-4 font-semibold">₱{{ $totalFine }}</td>
                            <td class="px-6 py-4 text-right">
                                @if($borrow->status === 'active')
                                    <a href="{{ route('borrows.edit', $borrow) }}"
                                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-xs">
                                        Return
                                    </a>
                                @else
                                    <span class="text-gray-500 text-xs">Completed</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                                No borrow records.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $borrows->links() }}
        </div>

    </div>
</x-app-layout>