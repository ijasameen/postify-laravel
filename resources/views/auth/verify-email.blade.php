<x-auth-layout>
    <div
        class="w-sm mt-7 bg-white border border-gray-200 rounded-xl shadow-2xs dark:bg-neutral-900 dark:border-neutral-700">
        <div class="p-4 sm:p-7">
            <div class="text-center">
                <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Email Verification</h1>
                <p class="text-gray-800 dark:text-white">A verification link has been sent to the email address you
                    provided during registration</p>
                @if (!Auth::user()->hasVerifiedEmail())
                    <form class="mt-5" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit"
                            class="w-full sm:w-auto py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-white text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none">
                            Resend
                        </button>
                    </form>
                @endif
            </div>
        </div>
</x-auth-layout>
