
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Avatar') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Add or updatae avatar.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.avatar') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @method('patch')
        @csrf

        <div>
                <x-input-label for="avatar" :value="__('Avatar')" />
                <div class="border border-gray-300 rounded-md shadow-sm p-1">
                    <input type="file" name="avatar" autofocus class="focus:border-indigo-500 focus:ring-indigo-500 w-full blockcursor-pointer">
                </div>

                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
