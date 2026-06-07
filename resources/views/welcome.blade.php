<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Task Management</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900">

    <header class="w-full py-5 px-6 sm:px-12 flex justify-between items-center bg-white border-b border-slate-100 shadow-sm">
        <div class="flex items-center gap-2">
            <div class="p-2 bg-indigo-600 rounded-lg text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
            </div>
            <span class="text-xl font-extrabold tracking-tight text-slate-800">OrchidTodo</span>
        </div>

        <nav class="flex gap-4 items-center">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 bg-indigo-50 px-4 py-2 rounded-lg transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg shadow-sm transition">Register</a>
                    @endif
                @endauth
            @endif
        </nav>
    </header>

    <main class="max-w-7xl mx-auto px-6 sm:px-12 py-20 lg:py-32 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        
        <div class="space-y-6 text-center lg:text-left">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-indigo-50 rounded-full text-indigo-700 text-xs font-semibold uppercase tracking-wider mx-auto lg:mx-0 w-fit">
                🚀 Dynamic Reactive Architecture
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 leading-tight">
                Manage your tasks <br class="hidden sm:inline">
                <span class="text-indigo-600 bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text text-transparent">with real-time feedback.</span>
            </h1>
            <p class="text-base sm:text-lg text-slate-500 max-w-xl mx-auto lg:mx-0">
                OrchidTodo murni ditenagai oleh Livewire v3 dan PostgreSQL, memberikan pengalaman mengelola pekerjaan tanpa adanya full-page reload. Cepat, aman, dan responsif.
            </p>
            
            <div class="pt-4 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-6 py-3.5 text-base font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-lg shadow-indigo-100 transition-all duration-150">
                        Go to Your Dashboard
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3.5 text-base font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-lg shadow-indigo-100 transition-all duration-150">
                        Get Started Free
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3.5 text-base font-semibold text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 rounded-xl transition-all duration-150">
                        Sign In to Account
                    </a>
                @endauth
            </div>
        </div>

        <div class="relative mx-auto lg:ml-auto w-full max-w-md lg:max-w-none">
            <div class="absolute -top-4 -left-4 w-72 h-72 bg-indigo-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob"></div>
            <div class="absolute -bottom-10 -right-4 w-72 h-72 bg-emerald-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000"></div>
            
            <div class="relative bg-white border border-slate-100 rounded-2xl shadow-xl p-6 space-y-4">
                <div class="flex items-center justify-between border-b border-slate-50 pb-3">
                    <span class="text-sm font-bold text-slate-700">Preview Workspace</span>
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center gap-3 p-3 bg-slate-50 border border-slate-100 rounded-xl opacity-60">
                        <input type="checkbox" checked disabled class="rounded border-slate-300 text-indigo-600">
                        <span class="text-sm line-through text-slate-400 font-medium">Setup PostgreSQL connection database</span>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-slate-50 border border-slate-100 rounded-xl opacity-60">
                        <input type="checkbox" checked disabled class="rounded border-slate-300 text-indigo-600">
                        <span class="text-sm line-through text-slate-400 font-medium">Integrate Laravel Breeze & Livewire v3</span>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white border border-indigo-100 shadow-sm rounded-xl">
                        <input type="checkbox" disabled class="rounded border-slate-300 text-indigo-600">
                        <span class="text-sm text-slate-700 font-medium">Build outstanding two-column dashboard UI</span>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <footer class="w-full text-center py-8 text-xs text-slate-400 border-t border-slate-100 bg-white mt-auto">
        &copy; {{ date('Y') }} OrchidTodo Core System. Built with clean state preservation.
    </footer>

</body>
</html>