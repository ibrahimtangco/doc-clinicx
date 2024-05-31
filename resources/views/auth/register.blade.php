
<x-guest-layout>
    <div class="w-full mt-6 px-6 py-4 lg:max-w-3xl bg-white sm:shadow-md overflow-hidden sm:rounded-lg">
        <div class="mb-8">
            <h1 class="text-title text-2xl font-semibold">Create Account</h1>
        </div>
    <form method="POST" action="{{ route('register') }}" class="w-full">
        @csrf

        <x-form-create :provinces="$provinces"/>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-text-desc hover:text-text-title" href="{{ route('login') }}">
                {{ __('Login account') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    </div>
    <script src="{{ asset('js/autofill_age.js') }}"></script>
    <script src="{{ asset('js/register_address_handler.js') }}"></script>
</x-guest-layout>
