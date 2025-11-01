<x-auth-layout>
    <div
        class="w-lg mt-7 bg-white border border-gray-200 rounded-xl shadow-2xs dark:bg-neutral-900 dark:border-neutral-700">
        <div class="p-4 sm:p-7">
            <div class="text-center">
                <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Sign up</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                    Already have an account?
                    <a class="text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500"
                        href="{{ route('login.create') }}">
                        Sign in here
                    </a>
                </p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('register.store') }}" class="mt-5">
                @csrf
                <div class="grid gap-y-4">
                    <div class="grid grid-cols-2 gap-3">
                        <!-- Form Group -->
                        <div>
                            <label for="firstName" class="block text-sm mb-2 dark:text-white">First Name</label>
                            <div class="relative">
                                <input type="text" id="firstName" name="firstName"
                                    class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    aria-describedby="firstNameError" value="{{ old('firstName') }}">
                            </div>
                            @if ($errors->get('firstName'))
                                @foreach ($errors->get('firstName') as $error)
                                    <p class="text-xs text-red-600 mt-2" id="firstNameError">{{ $error }}</p>
                                @endforeach
                            @endif
                        </div>
                        <!-- End Form Group -->

                        <!-- Form Group -->
                        <div>
                            <label for="lastName" class="block text-sm mb-2 dark:text-white">Last Name</label>
                            <div class="relative">
                                <input type="text" id="lastName" name="lastName"
                                    class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    aria-describedby="lastNameError" value="{{ old('lastName') }}">
                            </div>
                            @if ($errors->get('lastName'))
                                @foreach ($errors->get('lastName') as $error)
                                    <p class="text-xs text-red-600 mt-2" id="lastNameError">{{ $error }}</p>
                                @endforeach
                            @endif
                        </div>
                        <!-- End Form Group -->

                        <!-- Form Group -->
                        <div class="col-span-2">
                            <label for="email" class="block text-sm mb-2 dark:text-white">Email address</label>
                            <div class="relative">
                                <input type="email" id="email" name="email"
                                    class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    aria-describedby="emailError" value="{{ old('email') }}">
                            </div>
                            @if ($errors->get('email'))
                                @foreach ($errors->get('email') as $error)
                                    <p class="text-xs text-red-600 mt-2" id="emailError">{{ $error }}</p>
                                @endforeach
                            @endif
                        </div>
                        <!-- End Form Group -->

                        <!-- Form Group -->
                        <div>
                            <label for="password" class="block text-sm mb-2 dark:text-white">Password</label>
                            <div class="relative">
                                <input type="password" id="password" name="password"
                                    class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    aria-describedby="passwordError">
                            </div>
                            @if ($errors->get('password'))
                                @foreach ($errors->get('password') as $error)
                                    <p class="text-xs text-red-600 mt-2" id="passwordError">{{ $error }}</p>
                                @endforeach
                            @endif
                        </div>
                        <!-- End Form Group -->

                        <!-- Form Group -->
                        <div>
                            <label for="password_confirmation" class="block text-sm mb-2 dark:text-white">Confirm
                                Password</label>
                            <div class="relative">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    aria-describedby="passwordConfirmationError">
                                <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                                    <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            </div>
                            @if ($errors->get('password_confirmation'))
                                @foreach ($errors->get('password_confirmation') as $error)
                                    <p class="text-xs text-red-600 mt-2" id="passwordConfirmationError">
                                        {{ $error }}</p>
                                @endforeach
                            @endif
                        </div>
                        <!-- End Form Group -->
                    </div>

                    <button type="submit"
                        class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Sign
                        up</button>
                </div>
            </form>
            <!-- End Form -->
        </div>
    </div>
</x-auth-layout>
