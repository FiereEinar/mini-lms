<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mini Library Management System</title>

    <meta name="description" content="Mini Library Management System helps schools manage books, students, and borrow records efficiently. Track borrowed books, overdue returns, and library activity in one simple system.">

    <meta name="keywords" content="library management system, book tracking, school library software, borrow records, student library system">

    <meta name="author" content="Mini Library">

    <link rel="canonical" href="{{ url('/') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Lucide CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans text-gray-800">

    <!-- Navbar -->
    <header class="bg-white border-b shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div class="flex items-center space-x-2 font-bold text-indigo-600 text-lg">
                <i data-lucide="library-big" class="w-7 h-7"></i>
                <span>Mini Library</span>
            </div>

            <div class="space-x-4 text-sm">

                @auth
                <a href="{{ route('dashboard') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Dashboard
                </a>
                @else

                <a href="{{ route('login') }}"
                    class="text-gray-700 hover:text-indigo-600">
                    Login
                </a>

                <a href="{{ route('register') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Register
                </a>

                @endauth

            </div>

        </div>
    </header>


    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-10 items-center">

        <div>

            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
                Simple Library Management for Schools
            </h1>

            <p class="mt-4 text-lg text-gray-600">
                Manage books, students, and borrowing records efficiently with the Mini Library Management System.
                Track borrowed books, monitor overdue returns, and organize your library in one place.
            </p>

            <div class="mt-6 flex space-x-4">

                <a href="{{ route('login') }}"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Start Managing
                </a>

                <a href="#features"
                    class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                    Learn More
                </a>

            </div>

        </div>

        <div class="bg-white p-8 rounded-xl shadow-lg border">

            <div class="space-y-4">

                <div class="flex items-center space-x-3">
                    <i data-lucide="book-open" class="w-6 h-6 text-indigo-600"></i>
                    <span class="font-medium">Manage Books</span>
                </div>

                <div class="flex items-center space-x-3">
                    <i data-lucide="users" class="w-6 h-6 text-indigo-600"></i>
                    <span class="font-medium">Track Students</span>
                </div>

                <div class="flex items-center space-x-3">
                    <i data-lucide="archive" class="w-6 h-6 text-indigo-600"></i>
                    <span class="font-medium">Borrow Records</span>
                </div>

                <div class="flex items-center space-x-3">
                    <i data-lucide="clock" class="w-6 h-6 text-indigo-600"></i>
                    <span class="font-medium">Overdue Monitoring</span>
                </div>

            </div>

        </div>

    </section>


    <!-- Features -->
    <section id="features" class="bg-white border-t">

        <div class="max-w-7xl mx-auto px-6 py-16">

            <h2 class="text-3xl font-bold text-center text-gray-900">
                Library System Features
            </h2>

            <p class="text-center text-gray-600 mt-2">
                Everything you need to manage a small school library
            </p>

            <div class="grid md:grid-cols-3 gap-8 mt-12">

                <div class="bg-gray-50 p-6 rounded-xl border">

                    <i data-lucide="book" class="w-8 h-8 text-indigo-600"></i>

                    <h3 class="mt-4 font-semibold text-lg">
                        Book Catalog
                    </h3>

                    <p class="mt-2 text-sm text-gray-600">
                        Organize and manage your entire book collection including authors and availability.
                    </p>

                </div>

                <div class="bg-gray-50 p-6 rounded-xl border">

                    <i data-lucide="user-check" class="w-8 h-8 text-indigo-600"></i>

                    <h3 class="mt-4 font-semibold text-lg">
                        Student Management
                    </h3>

                    <p class="mt-2 text-sm text-gray-600">
                        Maintain a list of students and track their borrowing activity easily.
                    </p>

                </div>

                <div class="bg-gray-50 p-6 rounded-xl border">

                    <i data-lucide="alert-triangle" class="w-8 h-8 text-indigo-600"></i>

                    <h3 class="mt-4 font-semibold text-lg">
                        Overdue Tracking
                    </h3>

                    <p class="mt-2 text-sm text-gray-600">
                        Automatically identify overdue books and manage returns efficiently.
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- CTA -->
    <section class="bg-indigo-600 text-white">

        <div class="max-w-7xl mx-auto px-6 py-16 text-center">

            <h2 class="text-3xl font-bold">
                Start Managing Your Library Today
            </h2>

            <p class="mt-3 text-indigo-100">
                Track books, manage students, and monitor borrow records with ease.
            </p>

            <a href="{{ route('register') }}"
                class="inline-block mt-6 px-6 py-3 bg-white text-indigo-600 rounded-lg font-semibold hover:bg-gray-100 transition">
                Create Account
            </a>

        </div>

    </section>


    <!-- Footer -->
    <footer class="bg-white border-t">

        <div class="max-w-7xl mx-auto px-6 py-6 text-center text-sm text-gray-500">

            <p>
                © {{ date('Y') }} Mini Library Management System
            </p>

            <p class="mt-1">
                Built with Laravel and Tailwind CSS
            </p>

        </div>

    </footer>


    <script>
        lucide.createIcons();
    </script>

</body>

</html>