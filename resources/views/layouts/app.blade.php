<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex bg-stone-200 dark:bg-zinc-900 h-dvh">
    <aside class="fixed m-6 w-48 px-4 py-3 rounded-xs bg-stone-100 shadow-xl dark:bg-zinc-800 dark:text-zinc-50">
        <nav class="space-y-3">
            <div class="flex justify-between">
                <h2 class="font-bold text-lg">
                    <a href="{{ route('home') }}">Postify</a>
                </h2>
                <button type="button" class="hs-collapse-toggle open" id="hs-basic-collapse" aria-expanded="true"
                    aria-controls="hs-basic-collapse-heading" data-hs-collapse="#hs-basic-collapse-heading">
                    <span
                        class="hs-collapse-open:rotate-180 icon-[bx--up-arrow] size-5 text-zinc-400 hover:text-zinc-200"></span>
                </button>
            </div>
            <div id="hs-basic-collapse-heading" class="hs-collapse open pl-2 space-y-2"
                aria-labelledby="hs-basic-collapse">
                <h3 class="font-bold">Explore</h3>
                <div class="flex flex-col pl-1 space-y-1">
                    <a class="px-2 py-0.5 rounded-xs hover:shadow-md hover:bg-zinc-700" href="#">For you</a>
                    <a class="px-2 py-0.5 rounded-xs hover:shadow-md hover:bg-zinc-700" href="#">Trending</a>
                    <a class="px-2 py-0.5 rounded-xs hover:shadow-md hover:bg-zinc-700" href="#">Following</a>
                </div>
            </div>
        </nav>
    </aside>
    <main class="grow max-w-4xl mx-auto p-6 ">
        {{ $slot }}
    </main>
    <aside class="fixed right-0 m-6">
        <div class="flex flex-row-reverse items-center gap-2">
            @auth
                <div class="hs-dropdown relative inline-flex">
                    <button id="hs-dropdown-custom-trigger" type="button"
                        class="hs-dropdown-toggle py-1 ps-1 pe-3 inline-flex flex-col items-center gap-y-2 text-sm font-medium"
                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        <div class="size-14 rounded-full bg-zinc-400">
                        </div>
                    </button>
                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-zinc-800 dark:border dark:border-zinc-700"
                        role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-custom-trigger">
                        <div class="p-1 space-y-0.5">
                            <div class="flex items-start gap-3 py-3 px-4 border-b border-zinc-200 dark:border-neutral-700">
                                <p class="text-sm text-zinc-500 dark:text-neutral-400">Signed in as</p>
                                <div>
                                    <p class="text-sm font-medium text-zinc-800 dark:text-neutral-300">
                                        {{ Auth::user()->fullName }}
                                    </p>
                                    <p class="text-xs font-medium text-zinc-800 dark:text-zinc-300">
                                        {{ Auth::user()->email }}
                                    </p>
                                </div>
                            </div>
                            <button type="submit" form="logoutForm"
                                class="mt-1 w-full flex items-center gap-x-3.5 py-2 px-3 rounded-sm text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-zinc-400 dark:hover:bg-zinc-700 dark:hover:text-zinc-300 dark:focus:bg-zinc-700">
                                Sign Out
                            </button>
                            <form id="logoutForm" method="POST" action="{{ route('login.destroy') }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
                <button class="size-11 flex justify-center items-center rounded-full bg-zinc-400">
                    <span class="icon-[bx--bell] size-6"></span>
                </button>
                <a href="{{ route('posts.create') }}"
                    class="h-9 pr-4 pl-3 flex justify-center items-center gap-2 rounded-xs bg-zinc-400">
                    <span class="icon-[bx--pencil] size-6"></span>
                    New Post
                </a>
            @endauth

            @guest
                <a class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-sm border border-zinc-200 bg-white text-zinc-800 shadow-2xs hover:bg-zinc-50 focus:outline-hidden focus:bg-zinc-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                    href="{{ route('register.create') }}">
                    Sign Up
                </a>
                <a class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-sm border border-zinc-200 bg-white text-zinc-800 shadow-2xs hover:bg-zinc-50 focus:outline-hidden focus:bg-zinc-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                    href="{{ route('login') }}">
                    Sign In
                </a>
            @endguest
        </div>
    </aside>
</body>

</html>
