<x-app-layout>
    <div class="w-full max-w-2xl mx-auto">
        <div class="flex gap-3">
            <button class="flex items-center gap-2 justify-between pl-3 pr-2 py-1 bg-zinc-400 rounded-xs">
                Top
                <span class="icon-[bx--down-arrow] size-4"></span>
            </button>
        </div>
        <ul class="mt-5 space-y-6 dark:text-stone-50">
            @foreach ($posts as $post)
                <li>
                    <article class="relative bg-stone-50 shadow-md shadow-zinc-950/60 rounded-xs p-3 dark:bg-zinc-800">
                        <a href="{{ route('posts.show', ['post' => $post->id, 'slug' => $post->slug]) }}"
                            class="absolute size-full"></a>
                        <div class="flex flex-col min-h-60 border-2 px-4 py-3 border-zinc-700 border-dashed">
                            <div class="flex gap-2 items-start justify-between">
                                <div class="relative w-fit flex items-center gap-2">
                                    <span class="font-bold">from: </span>
                                    <span class="rounded-full size-8 dark:bg-zinc-600"></span>
                                    <a class="relative hover:underline" href="#">{{ $post->user->fullName }}</a>
                                </div>
                                @if (Auth::user()?->id === $post->user->id)
                                    <div class="hs-dropdown relative inline-flex">
                                        <button id="relative hs-dropdown-custom-icon-trigger" type="button"
                                            class="hs-dropdown-toggle flex justify-center items-center text-sm font-semibold rounded-sm"
                                            aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                            <span
                                                class="icon-[bx--dots-horizontal-rounded] size-7 dark:text-zinc-400 dark:hover:text-zinc-200"></span>
                                        </button>

                                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-xs mt-1 dark:bg-neutral-800 dark:border dark:border-neutral-700"
                                            role="menu" aria-orientation="vertical"
                                            aria-labelledby="hs-dropdown-custom-icon-trigger">
                                            <div class="p-1 space-y-0.5">
                                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-sm text-sm text-zinc-800 hover:bg-zinc-100 focus:outline-hidden focus:bg-zinc-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                    href="{{ route('posts.edit', ['post' => $post->id, 'slug' => $post->slug]) }}">
                                                    Edit
                                                </a>
                                                <button type="submit" form="deleteForm-{{ $post->id }}"
                                                    class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-sm text-sm text-zinc-800 hover:bg-zinc-100 focus:outline-hidden focus:bg-zinc-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700">
                                                    Delete
                                                </button>
                                                <form hidden id="deleteForm-{{ $post->id }}" method="POST"
                                                    action="{{ route('posts.destroy') }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input hidden type="text" name="id"
                                                        value="{{ $post->id }}">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-3 space-y-2 grow">
                                <h2 class="text-2xl">{{ $post->title }}</h2>
                                <p> {{ $post->summary }}</p>
                            </div>
                            <div class="flex items-end justify-between gap-2 ">
                                <div class="relative w-fit mt-4 flex items-center gap-5">
                                    <div class="flex items-center gap-1">
                                        <button class="icon-[bx--heart] size-6"></button>
                                        <span>12</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <button class="icon-[bx--comment-detail] size-6"></button>
                                        <span>4</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <button class="icon-[bx--bookmark] size-6"></button>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <button class="icon-[bx--share-alt] size-6"></button>
                                    </div>
                                </div>
                                <span class="text-sm dark:text-zinc-400">{{ $post->getPostedTimeText() }}</span>
                            </div>
                        </div>
                    </article>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
