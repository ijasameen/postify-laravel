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
                            <div class="flex gap-2 items-center">
                                <div class="relative w-fit flex items-center gap-2">
                                    <span class="font-bold">from: </span>
                                    <span class="rounded-full size-8 dark:bg-zinc-600"></span>
                                    <a class="relative hover:underline" href="#">{{ $post->user->fullName }}</a>
                                </div>
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
