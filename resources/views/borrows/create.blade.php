<x-app-layout>
    <x-slot name="header">New Borrow</x-slot>

    <div>

        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('borrows.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Student</label>
                    <select name="student_id" class="w-full border rounded-lg px-3 py-2">
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Books</label>
                    <select name="books[]" multiple class="w-full border rounded-lg px-3 py-2">
                        @foreach($books as $book)
                            <option value="{{ $book->id }}">
                                {{ $book->title }} (Available: {{ $book->available_copies }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                    <input type="date" name="due_date" class="w-full border rounded-lg px-3 py-2" required>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('borrows.index') }}"
                       class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">
                        Cancel
                    </a>

                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                        Save Borrow
                    </button>
                </div>

            </form>
        </div>

    </div>
</x-app-layout>