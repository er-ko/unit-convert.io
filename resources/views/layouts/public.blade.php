<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.head')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    </head>
    <body class="font-sans antialiased">
        @isset($search)
            {{ $search }}
        @endisset
        <div id="wrapper" class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900">
            <div class="w-full min-h-screen max-w-2xl px-6 lg:max-w-1xl flex flex-col">

                <header class="mb-auto"></header>

                <main class="mb-auto">
                    {{ $slot }}
                </main>

                <footer class="flex items-center justify-center mt-12 py-6 text-center text-sm border-t border-dashed text-black border-gray-200 dark:border-slate-700">
                    <small class="text-gray-600 dark:text-slate-500">&copy; {{ date('Y') }}<a href="{{ url('/') }}" class="ms-2 ps-2 border-l text-gray-400 border-gray-300 dark:text-slate-500 dark:border-slate-700">unit-convert.io</a></small>
                </footer>
            </div>
        </div>
        @stack('slotscript')
    </body>
</html>