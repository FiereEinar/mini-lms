<x-app-layout>

<div class="max-w-2xl">

    <h1 class="text-2xl font-semibold text-gray-800 mb-6">
        Add Student
    </h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('students.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Name
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

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Student Number
                </label>
                <input type="text"
                       name="student_number"
                       value="{{ old('student_number') }}"
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none
                       @error('student_number') border-red-500 @enderror">

                @error('student_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('students.index') }}"
                   class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">
                    Cancel
                </a>

                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                    Save Student
                </button>
            </div>
        </form>
    </div>

</div>
</x-app-layout>
