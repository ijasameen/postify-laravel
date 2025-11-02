<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xs shadow-xs p-4 sm:p-7 dark:bg-zinc-800">
            <div class="mb-8">
                <h2 class="text-xl font-bold text-zinc-800 dark:text-zinc-200">
                    New Post
                </h2>
            </div>

            <form method="POST" action="{{ route('posts.store') }}">
                @csrf
                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">
                    <div class="sm:col-span-3">
                        <label for="title" class="inline-block text-sm text-zinc-800 mt-2.5 dark:text-zinc-200">
                            Title
                        </label>
                    </div>

                    <div class="sm:col-span-9">
                        <input id="title" type="text" name="title"
                            class="py-1.5 sm:py-2 px-3 pe-11 block w-full border-zinc-200 shadow-2xs sm:text-sm rounded-sm focus:border-blue-500 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-zinc-800 dark:border-zinc-700 dark:text-zinc-400 dark:placeholder-zinc-500 dark:focus:ring-zinc-600"
                            placeholder="What is this about?" value="{{ old('title') }}">
                        @if ($errors->get('title'))
                            @foreach ($errors->get('title') as $error)
                                <p class="text-xs text-red-600 mt-2">{{ $error }}
                                </p>
                            @endforeach
                        @endif
                    </div>

                    <div class="sm:col-span-3">
                        <label for="summary" class="inline-block text-sm text-zinc-800 mt-2.5 dark:text-zinc-200">
                            Summary
                        </label>
                    </div>

                    <div class="sm:col-span-9">
                        <textarea id="summary" name="summary"
                            class="py-1.5 sm:py-2 px-3 block w-full border-zinc-200 rounded-sm sm:text-sm focus:border-blue-500 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-zinc-800 dark:border-zinc-700 dark:text-zinc-400 dark:placeholder-zinc-500 dark:focus:ring-zinc-600"
                            rows="6" placeholder="Type your story...">{{ old('summary') }}</textarea>
                        @if ($errors->get('summary'))
                            @foreach ($errors->get('summary') as $error)
                                <p class="text-xs text-red-600 mt-2">{{ $error }}
                                </p>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="mt-5 flex justify-end gap-x-2">
                    <a href="{{ route('home') }}"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-sm border border-zinc-200 bg-white text-zinc-800 shadow-2xs hover:bg-zinc-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-zinc-50 dark:bg-transparent dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:focus:bg-zinc-800">
                        Cancel
                    </a>
                    <button type="submit"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-sm border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Post
                    </button>
                </div>
            </form>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Card Section -->
</x-app-layout>
