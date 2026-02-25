<x-app-layout>
    <x-slot name="header">
        Books
    </x-slot>

    <div>

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">
                Books
            </h2>

            <a href="{{ route('books.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow">
                + Add Book
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-100 text-xs uppercase tracking-wider text-gray-700">
                    <tr>
                        <th class="px-6 py-3">Title</th>
                        <th class="px-6 py-3">Authors</th>
                        <th class="px-6 py-3">Available / Total</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($books as $book)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $book->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $book->authors->pluck('name')->join(', ') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $book->available_copies }} / {{ $book->total_copies }}
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">

                                <a href="{{ route('books.edit', $book) }}"
                                   class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-xs">
                                    Edit
                                </a>

                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Delete this book?')"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs">
                                        Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                                No books found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $books->links() }}
        </div>

    </div>
</x-app-layout>