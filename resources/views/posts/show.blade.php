<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('home') }}" class="block mb-3">
            <div class="size-12 border border-zinc-100 flex justify-center items-center rounded-full">
                <span class="icon-[bx--arrow-back] size-8 dark:text-zinc-400"></span>
            </div>
        </a>
        <div class="flex flex-col min-h-60 px-4 py-3 dark:text-zinc-50">
            <div class="flex gap-2 items-start justify-between">
                <div class="flex items-center gap-2">
                    <span class="font-bold">from: </span>
                    <span class="rounded-full size-8 dark:bg-zinc-600"></span>
                    <a class="hover:underline" href="#">{{ $post->user->fullName }}</a>
                </div>
                @if (Auth::user()?->id === $post->user->id)
                    <div class="flex gap-2">
                        <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-sm border border-zinc-200 bg-white text-zinc-800 shadow-2xs hover:bg-zinc-50 focus:outline-hidden focus:bg-zinc-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-zinc-800 dark:border-zinc-700 dark:text-white dark:hover:bg-zinc-700 dark:focus:bg-zinc-700"
                            href="{{ route('posts.edit', ['post' => $post->id, 'slug' => $post->slug]) }}">
                            <span class="icon-[bx--pencil] size-6"></span>
                            Edit
                        </a>
                        <button type="submit" form="deleteForm"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-sm border border-zinc-200 bg-white text-zinc-800 shadow-2xs hover:bg-zinc-50 focus:outline-hidden focus:bg-zinc-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-zinc-800 dark:border-zinc-700 dark:text-white dark:hover:bg-red-500/80 dark:focus:bg-zinc-700">
                            <span class="icon-[bx--trash] size-6"></span>
                            Delete
                        </button>

                        <form hidden id="deleteForm" method="POST" action="{{ route('posts.destroy') }}">
                            @csrf
                            @method('DELETE')
                            <input hidden type="text" name="id" value="{{ $post->id }}">
                        </form>
                    </div>
                @endif
            </div>
            <div class="mt-3 space-y-2 grow">
                <h1 class="text-2xl">{{ $post->title }}</h1>
                <p> {{ $post->summary }}</p>
            </div>
            <div class="mt-4 flex items-center gap-5">
                <div class="flex items-center gap-1">
                    <button class="icon-[bx--heart] size-6"></button>
                    <span>12</span>
                </div>
                <div class="flex items-center gap-1">
                    <button class="icon-[bx--comment-detail] size-6"></button>
                    <span>{{ count($post->replies) }}</span>
                </div>
                <div class="flex items-center gap-1">
                    <button class="icon-[bx--bookmark] size-6"></button>
                </div>
                <div class="flex items-center gap-1">
                    <button class="icon-[bx--share-alt] size-6"></button>
                </div>
            </div>
        </div>
        <div class="mt-8">
            <h2 class="dark:text-zinc-50 font-bold text-xl">Replies</h2>
            @if (Auth::user()?->id === $post->user->id)
                <form method="POST" action={{ route('replies.store') }}>
                    <div class="mt-4 relative">
                        @csrf
                        <input hidden type="text" name="post_id" value="{{ $post->id }}">
                        <textarea id="body" name="body"
                            class="p-3 sm:p-4 pb-12 sm:pb-12 block w-full border-zinc-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-zinc-900 dark:border-zinc-700 dark:text-zinc-400 dark:placeholder-zinc-500 dark:focus:ring-zinc-600"
                            placeholder="Say something..." data-hs-textarea-auto-height="">{{ old('body') }}</textarea>
                        <div class="absolute bottom-px inset-x-px p-2 rounded-b-md bg-white dark:bg-zinc-900">
                            <div class="flex flex-wrap justify-end items-center gap-2">
                                <button type="submit"
                                    class="inline-flex shrink-0 px-2 py-1 gap-1 justify-center items-center rounded-sm text-white bg-blue-600 hover:bg-blue-500 focus:z-10 focus:outline-hidden focus:bg-blue-500">
                                    <span class="icon-[bx--comment-detail] size-5"></span>
                                    Reply
                                </button>
                            </div>
                        </div>
                    </div>
                    @if ($errors->get('body'))
                        @foreach ($errors->get('body') as $error)
                            <p class="text-xs text-red-600 mt-2">{{ $error }}
                            </p>
                        @endforeach
                    @endif
                </form>
            @endif
        </div>
        <ul class="mt-6 ml-4 space-y-6 dark:text-zinc-50">
            @foreach ($post->replies as $reply)
                <li class="flex group">
                    <div class="w-full bg-stone-50 shadow-md shadow-zinc-950/60 rounded-xs p-4 dark:bg-zinc-800">
                        <div class="flex gap-2 items-start justify-between">
                            <div class="relative w-fit flex items-center gap-2">
                                <span class="font-bold">from: </span>
                                <span class="rounded-full size-8 dark:bg-zinc-600"></span>
                                <a class="relative hover:underline" href="#">{{ $reply->user->fullName }}</a>
                            </div>
                            @if (Auth::user()?->id === $reply->user->id)
                                <div class="hs-dropdown relative inline-flex">
                                    <button id="relative hs-dropdown-custom-icon-trigger" type="button"
                                        class="hs-dropdown-toggle flex justify-center items-center text-sm font-semibold rounded-sm"
                                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                        <span
                                            class="icon-[bx--dots-horizontal-rounded] size-7 dark:text-zinc-400 dark:hover:text-zinc-200"></span>
                                    </button>

                                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-xs mt-1 dark:bg-zinc-800 dark:border dark:border-zinc-700"
                                        role="menu" aria-orientation="vertical"
                                        aria-labelledby="hs-dropdown-custom-icon-trigger">
                                        <div class="p-1 space-y-0.5">
                                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-sm text-sm text-zinc-800 hover:bg-zinc-100 focus:outline-hidden focus:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-700 dark:hover:text-zinc-300 dark:focus:bg-zinc-700"
                                                href="#">
                                                Edit
                                            </a>
                                            <button type="submit" form="deleteForm-{{ $reply->id }}"
                                                class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-sm text-sm text-zinc-800 hover:bg-zinc-100 focus:outline-hidden focus:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-700 dark:hover:text-zinc-300 dark:focus:bg-zinc-700">
                                                Delete
                                            </button>
                                            <form hidden id="deleteForm-{{ $reply->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <input hidden type="text" name="id"
                                                    value="{{ $reply->id }}">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="mt-3 space-y-2 grow">
                            <p>{{ $reply->body }}</p>
                        </div>
                        <div class="mt-5 flex items-center gap-5">
                            <div class="flex items-center gap-1">
                                <button class="icon-[bx--heart] size-5"></button>
                                <span>12</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <button class="icon-[bx--bookmark] size-5"></
                                        class="dark:text-zinc-50 font-bold text-xl"buttonRepliesdiv6 mt-8 <div
                                        class="flex items-center gap-1">
                                    <button class="icon-[bx--share-alt] size-5"></button>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    </div>
</x-app-layout>
