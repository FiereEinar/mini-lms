<x-app-layout>
    <x-slot name="header">
        Add Author
    </x-slot>

    <div class="max-w-2xl">

        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('authors.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Author Name
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none
                           @error('name') border-red-500 @enderror">

                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('authors.index') }}"
                       class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">
                        Cancel
                    </a>

                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                        Save Author
                    </button>
                </div>

            </form>
        </div>

    </div>
</x-app-layout>