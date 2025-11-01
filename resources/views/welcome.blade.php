<x-app-layout>
    <div class="max-w-6xl size-full mx-auto flex justify-center items-center">
        <!-- ========== MAIN CONTENT ========== -->
        <div class="text-center py-10 px-4 sm:px-6 lg:px-8">
            <h1 class="block text-2xl font-bold text-white sm:text-4xl">Welcome!</h1>
            @auth
                <p class="mt-3 text-md text-gray-300">{{ Auth::user()->username }}</p>
            @endauth
            <p class="mt-3 text-lg text-gray-300">Stay tuned!</p>
            <div class="mt-5 flex flex-col justify-center items-center gap-2 sm:flex-row sm:gap-3">
                @auth
                    <button type="submit" form="logoutForm"
                        class="w-full sm:w-auto py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-white text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none">
                        Log Out
                    </button>
                    <form hidden id="logoutForm" method="POST" action="{{ route('login.destroy') }}">
                        @csrf
                        @method('DELETE')
                    </form>
                @endauth
                @guest
                    <div class="flex gap-2">
                        <a href="{{ route('login.create') }}"
                            class="w-full sm:w-auto py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-white text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none">
                            Sign In
                        </a>
                        <a href="{{ route('register.create') }}"
                            class="w-full sm:w-auto py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-white text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none">
                            Sign Up
                        </a>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</x-app-layout>
