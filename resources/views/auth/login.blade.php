<x-guest-layout>

    <div class="min-h-screen flex">

        <!-- Left Panel (Desktop Only) -->
        <div class="hidden lg:flex w-1/2 bg-indigo-600 text-white items-center justify-center p-12">

            <div class="max-w-md">

                <div class="flex items-center space-x-2 text-2xl font-bold mb-6 text-white">
                    <x-icon name="library-big" class="w-8 h-8" />
                    <span>Mini Library</span>
                </div>

                <h1 class="text-4xl font-bold leading-tight">
                    Welcome Back
                </h1>

                <p class="mt-4 text-indigo-100">
                    Manage books, students, and borrow records efficiently.
                    Log in to access your library dashboard.
                </p>

                <div class="mt-8 space-y-4 text-sm">

                    <div class="flex items-center space-x-3">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                        <span>Track books and authors</span>
                    </div>

                    <div class="flex items-center space-x-3">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        <span>Manage student borrowers</span>
                    </div>

                    <div class="flex items-center space-x-3">
                        <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                        <span>Monitor overdue books</span>
                    </div>

                </div>

            </div>

        </div>


        <!-- Login Form -->
        <div class="flex flex-1 items-center justify-center bg-gray-50 px-6 py-12">

            <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg border">

                <div class="text-center mb-6">

                    <div class="flex justify-center mb-2">
                        <i data-lucide="library-big" class="w-8 h-8 text-indigo-600"></i>
                    </div>

                    <h2 class="text-2xl font-bold text-gray-800">
                        Login to your account
                    </h2>

                    <p class="text-sm text-gray-500">
                        Access the library management dashboard
                    </p>

                </div>


                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-input-error :messages="$errors->all()" class="mb-4" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Email Address
                        </label>

                        <div class="relative">
                            <i data-lucide="mail" class="w-4 h-4 absolute left-3 top-3 text-gray-400"></i>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Password
                        </label>

                        <div class="relative">
                            <i data-lucide="lock" class="w-4 h-4 absolute left-3 top-3 text-gray-400"></i>

                            <input
                                type="password"
                                name="password"
                                required
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    <!-- Remember + Forgot -->
                    <div class="flex items-center justify-between text-sm">

                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="remember" class="rounded border-gray-300">
                            <span class="text-gray-600">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-indigo-600 hover:text-indigo-800">
                            Forgot password?
                        </a>
                        @endif

                    </div>

                    <!-- Login Button -->
                    <button
                        type="submit"
                        class="w-full bg-indigo-600 text-white py-2 rounded-lg font-medium hover:bg-indigo-700 transition">
                        Login
                    </button>

                    <!-- Register Link -->
                    <p class="text-center text-sm text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}"
                            class="text-indigo-600 hover:text-indigo-800 font-medium">
                            Register
                        </a>
                    </p>

                </form>

            </div>

        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>

</x-guest-layout>