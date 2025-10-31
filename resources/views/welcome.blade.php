<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="container px-4 mx-auto space-y-8 dark:bg-neutral-950">
    <header>
        <h1 class="text-5xl font-bold dark:text-neutral-100">Postify</h1>
    </header>
    <main>
        <div
            class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xs dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="p-4 md:p-5">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                    Card title
                </h3>
                <p class="mt-2 text-gray-500 dark:text-neutral-400">
                    With supporting text below as a natural lead-in to additional content.
                </p>
                <a class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent text-blue-600 decoration-2 hover:text-blue-700 hover:underline focus:underline focus:outline-hidden focus:text-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-600 dark:focus:text-blue-600"
                    href="#">
                    Card link
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </a>
            </div>
            <div
                class="bg-gray-100 border-t border-gray-200 rounded-b-xl py-3 px-4 md:py-3 md:px-5 dark:bg-neutral-900 dark:border-neutral-700">
                <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
                    <button class="icon-[bx--like] size-6 hover:icon-[bxs--like] hover:size-6"></span>
                </p>
            </div>
        </div>
        </div>
</body>

</html>
