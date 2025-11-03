<x-app-layout>
    <div class="flex items-center gap-3 dark:text-zinc-50">
        <div class="size-18 rounded-full bg-zinc-400">
        </div>
        <div class="space-y-1 ">
            <h2 class="">{{ $profileOwner->fullName }}'s Profile</h2>
            <div class="dark:text-zinc-300">{{ '@' . $profileOwner->username }}</div>
        </div>
    </div>
    <div>
        <div class="mt-5 border-b border-gray-200 dark:border-neutral-700">
            <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                <a href="{{ $overviewRoute }}"
                    class="data-active:pointer-events-none data-active:font-semibold data-active:border-blue-600 data-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-hidden focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500"
                    {{ $isOverviewActive ? 'aria-selected="true" data-active' : 'aria-selected="false"' }}>
                    Overview
                </a>
                <a href="{{ $postsRoute }}"
                    class="data-active:pointer-events-none data-active:font-semibold data-active:border-blue-600 data-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-hidden focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500"
                    {{ $isPostsActive ? 'aria-selected="true" data-active' : 'aria-selected="false"' }}>
                    Posts </a>
                <a href="{{ $repliesRoute }}"
                    class="data-active:pointer-events-none data-active:font-semibold data-active:border-blue-600 data-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-hidden focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500"
                    {{ $isRepliesActive ? 'aria-selected="true" data-active' : 'aria-selected="false"' }}>
                    Replies </a>
                <a href="{{ $savedRoute }}"
                    class="data-active:pointer-events-none data-active:font-semibold data-active:border-blue-600 data-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-hidden focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500"
                    {{ $isSavedActive ? 'aria-selected="true" data-active' : 'aria-selected="false"' }}>
                    Saved </a>
            </nav>
        </div>
    </div>
    <div class="mt-6">
        {{ $slot }}
    </div>
</x-app-layout>
