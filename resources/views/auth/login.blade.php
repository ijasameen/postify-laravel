<x-auth-layout>
    <div
        class="w-sm mt-7 bg-white border border-gray-200 rounded-xl shadow-2xs dark:bg-neutral-900 dark:border-neutral-700">
        <div class="p-4 sm:p-7">
            <div class="text-center">
                <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Sign in</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                    Don't have an account yet?
                    <a class="text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500"
                        href="#">
                        Sign up here
                    </a>
                </p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login.store') }}" class="mt-5">
                @csrf
                <div class="grid gap-y-4">
                    <!-- Form Group -->
                    <div>

                        <label for="email" class="block text-sm mb-2 dark:text-white">Email address</label>
                        <div class="relative">
                            <input type="email" id="email" name="email"
                                class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                aria-describedby="auth-error" value="{{ old('email') }}">
                        </div>
                        @if ($errors->get('email'))
                            @foreach ($errors->get('email') as $error)
                                <p class="text-xs text-red-600 mt-2" id="auth-error">{{ $error }}</p>
                            @endforeach
                        @endif
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div>
                        <div class="flex flex-wrap justify-between items-center gap-2">
                            <label for="password" class="block text-sm mb-2 dark:text-white">Password</label>
                            <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500"
                                href="#">Forgot password?</a>
                        </div>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                aria-describedby="auth-error">
                        </div>
                        @if ($errors->get('password'))
                            @foreach ($errors->get('password') as $error)
                                <p class="text-xs text-red-600 mt-2" id="auth-error">{{ $error }}</p>
                            @endforeach
                        @endif
                    </div>
                    <!-- End Form Group -->

                    @if ($errors->get('auth'))
                        @foreach ($errors->get('auth') as $error)
                            <p class="text-xs text-red-600 mt-2" id="auth-error">{{ $error }}
                            </p>
                        @endforeach
                    @endif

                    <!-- Checkbox -->
                    <div class="flex items-center">
                        <div class="flex">
                            <input id="remember" name="remember" type="checkbox"
                                class="shrink-0 mt-0.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                        </div>
                        <div class="ms-3">
                            <label for="remember" class="text-sm dark:text-white">Remember me</label>
                        </div>
                    </div>
                    <!-- End Checkbox -->

                    <button type="submit"
                        class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Sign
                        in</button>
                </div>
            </form>
            <!-- End Form -->
        </div>
    </div>
</x-auth-layout>
