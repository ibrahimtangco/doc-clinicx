<x-guest-layout>
	<!-- Session Status -->
	<x-auth-session-status :status="session('status')" class="mb-4" />
	<div class="mb-8">
		<h1 class="text-title text-2xl font-semibold">Login your account</h1>
	</div>
	<form action="{{ route('login') }}" method="POST">
		@csrf

		<!-- Email Address -->
		<div>
			<x-input-label :value="__('Email')" for="email" />
			<x-text-input :value="old('email')" autocomplete="username" autofocus class="block mt-1 w-full" id="email" name="email"
				required type="email" />
			<x-input-error :messages="$errors->get('email')" class="mt-2" />
		</div>

		<!-- Password -->
		<div class="mt-4">


			<div class="py-2" x-data="{ show: true }">
                <x-input-label :value="__('Password')" for="password" />
                <div class="relative">
                  <input name="password" :type="show ? 'password' : 'text'" class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 shadow-sm
                focus:bg-white
                focus:border-indigo-500
                focus:ring-indigo-500
                focus:outline-none">

                {{-- border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm --}}
                  <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                    <?xml version="1.0" ?><svg class="bi bi-eye-slash-fill cursor-pointer fill-text-desc hover:fill-gray-600" fill="currentColor"
                    @click="show = !show"
                      :class="{'hidden': !show, 'block':show }"
                       height="20px" viewBox="0 0 16 16" width="20px" xmlns="http://www.w3.org/2000/svg"><path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/><path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/></svg>



                    <?xml version="1.0" ?><svg class="bi bi-eye-fill cursor-pointer fill-text-desc hover:fill-gray-600" fill="currentColor" @click="show = !show"
                      :class="{'block': !show, 'hidden':show }" height="20px" viewBox="0 0 16 16" width="20px" xmlns="http://www.w3.org/2000/svg"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/></svg>

                  </div>
                </div>
              </div>

			<x-input-error :messages="$errors->get('password')" class="mt-2" />
		</div>

		<!-- Remember Me -->
		<div class="flex items-center justify-between mt-4">
			<label class="inline-flex items-center cursor-pointer" for="remember_me">
				<input
					class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
					id="remember_me" name="remember" type="checkbox">
				<span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
			</label>
			@if (Route::has('password.request'))
				<a
					class="text-sm text-link hover:underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
					href="{{ route('password.request') }}">
					{{ __('Forgot your password?') }}
				</a>
			@endif
		</div>

		<div class="mt-8 flex flex-col items-center gap-4">
			<x-primary-button class="w-full py-3">
				{{ __('Log in') }}
			</x-primary-button>

		</div>
		<a class="text-center block pt-3 underline text-sm text-text-desc hover:text-text-title rounded-md"
			href="{{ route('register') }}">
			{{ __('Don\'t have an account?') }}
		</a>
	</form>
</x-guest-layout>
