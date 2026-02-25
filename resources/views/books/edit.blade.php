<x-app-layout>
    <x-slot name="header">
        Add Book
    </x-slot>

    <div class="max-w-2xl">

        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('books.update', $book) }}" method="PUT" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title', $book->title) }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none
                        @error('title') border-red-500 @enderror">
                    @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none
                        @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Total Copies</label>
                    <input type="number" name="total_copies" value="{{ old('total_copies', 1) }}" min="1"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none
                        @error('total_copies') border-red-500 @enderror">
                    @error('total_copies') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Authors</label>
                    <select name="authors[]" multiple
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none
                        @error('authors') border-red-500 @enderror">
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ in_array($author->id, old('authors', $bookAuthors)) ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('authors') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('books.index') }}"
                       class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">
                        Cancel
                    </a>

                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                        Save Book
                    </button>
                </div>

            </form>
        </div>

    </div>
</x-app-layout>