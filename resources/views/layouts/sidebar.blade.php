<aside class="w-64 shrink-0 bg-white border-r border-gray-200 min-h-screen flex flex-col">

    {{-- Logo / System Name --}}
    <div class="px-6 py-5 border-b">
        <h1 class="text-xl font-bold text-indigo-600 flex items-center">
            <x-icon name="library-big" class="w-8 h-8 mr-2" /> Mini Library
        </h1>
        <p class="text-xs text-gray-500 mt-1">
            Management System
        </p>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-6 space-y-2 text-sm">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center px-4 py-2 rounded-lg transition
           {{ request()->routeIs('dashboard') 
                ? 'bg-indigo-100 text-indigo-700 font-semibold'
                : 'text-gray-600 hover:bg-gray-100 hover:text-indigo-600' }}">

            <x-icon name="home" class="w-5 h-5 mr-3" />
            Dashboard
        </a>

        {{-- Students --}}
        <a href="{{ route('students.index') }}"
           class="flex items-center px-4 py-2 rounded-lg transition
           {{ request()->routeIs('students.*') 
                ? 'bg-indigo-100 text-indigo-700 font-semibold'
                : 'text-gray-600 hover:bg-gray-100 hover:text-indigo-600' }}">

            <x-icon name="graduation-cap" class="w-5 h-5 mr-3" />
            Students
        </a>

        {{-- Authors --}}
        <a href="{{ route('authors.index') }}"
           class="flex items-center px-4 py-2 rounded-lg transition
           {{ request()->routeIs('authors.*') 
                ? 'bg-indigo-100 text-indigo-700 font-semibold'
                : 'text-gray-600 hover:bg-gray-100 hover:text-indigo-600' }}">

            <x-icon name="pen-tool" class="w-5 h-5 mr-3" />
            Authors
        </a>

        {{-- Books --}}
        <a href="{{ route('books.index') }}"
           class="flex items-center px-4 py-2 rounded-lg transition
           {{ request()->routeIs('books.*') 
                ? 'bg-indigo-100 text-indigo-700 font-semibold'
                : 'text-gray-600 hover:bg-gray-100 hover:text-indigo-600' }}">

            <x-icon name="book-open" class="w-5 h-5 mr-3" />
            Books
        </a>

        {{-- Borrows --}}
        <a href="{{ route('borrows.index') }}"
           class="flex items-center px-4 py-2 rounded-lg transition
           {{ request()->routeIs('borrows.*') 
                ? 'bg-indigo-100 text-indigo-700 font-semibold'
                : 'text-gray-600 hover:bg-gray-100 hover:text-indigo-600' }}">

            <x-icon name="archive" class="w-5 h-5 mr-3" />
            Borrow Records
        </a>

    </nav>

    {{-- Footer --}}
    <div class="px-6 py-4 border-t text-xs text-gray-400">
        © {{ date('Y') }} Mini Library
    </div>

</aside>