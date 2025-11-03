@php
    $user = Auth::user();
@endphp

<x-profile-layout :$profileOwner>
    <div class="w-full max-w-2xl mx-auto">
        <div class="flex gap-3">
            <button class="flex items-center gap-2 justify-between pl-3 pr-2 py-1 bg-zinc-400 rounded-xs">
                Top
                <span class="icon-[bx--down-arrow] size-4"></span>
            </button>
        </div>
        <ul class="mt-5 space-y-6 dark:text-zinc-50">
            @foreach ($profileOwner->replies as $reply)
                <li class="flex group">
                    <div id="{{ $reply->getClassKey() }}-{{ $reply->id }}"
                        class="w-full bg-stone-50 shadow-md shadow-zinc-950/60 rounded-xs p-4 dark:bg-zinc-800">
                        <div class="mt-3 flex gap-2 items-start justify-between">
                            {{-- <div class="relative w-fit flex items-center gap-2">
                                <span class="font-bold">from: </span>
                                <span class="rounded-full size-8 dark:bg-zinc-600"></span>
                                <a class="relative hover:underline" href="{{ route('profile', ['user' => $reply->user->username]) }}">{{ $reply->user->fullName }}</a>
                            </div> --}}
                            <div class="relative w-fit flex items-center gap-2">
                                <span class="font-bold">Replying to: </span>
                                <a class="relative hover:underline p-2 rounded-sm dark:bg-zinc-700"
                                    href="{{ route('posts.show', ['post' => $reply->post->id, 'slug' => $reply->post->slug]) }}">{{ $reply->post->title }}</a>
                            </div>
                            @if ($user?->id === $reply->user->id)
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
                                            <form hidden method="POST" action="{{ route('replies.destroy') }}"
                                                id="deleteForm-{{ $reply->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <input hidden type="text" name="id" value="{{ $reply->id }}">
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
                                <button type="submit" form="like-reply-{{ $reply->id }}-form"
                                    class="{{ $reply->isAuthenticatedUserLiked() ? 'icon-[bxs--heart] size-5' : 'icon-[bx--heart] size-5' }}"></button>
                                <span>{{ $reply->liked_users_count }}</span>
                                <form id="like-reply-{{ $reply->id }}-form" method="POST"
                                    action="{{ route('likes.update') }}">
                                    @csrf
                                    @method('PUT')
                                    <input hidden type="text" name="likable_type_alias"
                                        value="{{ $reply::getClassKey() }}">
                                    <input hidden type="text" name="likable_id" value="{{ $reply->id }}">
                                </form>
                            </div>
                            <div class="flex items-center gap-1">
                                <button type="submit" form="save-reply-{{ $reply->id }}-form"
                                    class="{{ $reply->isAuthenticatedUserSaved() ? 'icon-[bxs--bookmark] size-5' : 'icon-[bx--bookmark] size-5' }}"></button>
                                <form id="save-reply-{{ $reply->id }}-form" method="POST"
                                    action="{{ route('saves.update') }}">
                                    @csrf
                                    @method('PUT')
                                    <input hidden type="text" name="savable_type_alias"
                                        value="{{ $reply::getClassKey() }}">
                                    <input hidden type="text" name="savable_id" value="{{ $reply->id }}">
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-profile-layout>
