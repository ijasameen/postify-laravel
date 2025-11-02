<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('home') }}" class="block mb-3">
            <div class="size-12 border border-zinc-100 flex justify-center items-center rounded-full">
                <span class="icon-[bx--arrow-back] size-8 dark:text-zinc-400"></span>
            </div>
        </a>
        <article>
            <div class="flex flex-col min-h-60 px-4 py-3 dark:text-zinc-50">
                <div class="flex items-center gap-2">
                    <span class="font-bold">from: </span>
                    <span class="rounded-full size-8 dark:bg-zinc-600"></span>
                    <a class="hover:underline" href="#">{{ $post->user->fullName }}</a>
                </div>
                <div class="mt-3 space-y-2 grow">
                    <h2 class="text-2xl">{{ $post->title }}</h2>
                    <p> {{ $post->summary }}</p>
                </div>
                <div class="mt-4 flex items-center gap-5">
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
            </div>
        </article>
    </div>
</x-app-layout>
