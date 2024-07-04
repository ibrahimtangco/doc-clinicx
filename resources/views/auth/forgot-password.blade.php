<x-guest-layout>
	<div class="max-w-md mx-auto px-4 md:bg-gray-50 md:shadow md:p-6 md:rounded-lg mt-6">
		<div class="mb-4 text-sm text-gray-600">
			{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
		</div>

		<!-- Session Status -->
		<x-auth-session-status :status="session('status')" class="mb-4" />

		<form action="{{ route('password.email') }}" method="POST">
			@csrf

			<!-- Email Address -->
			<div>
				<x-input-label :value="__('Email')" for="email" />
				<x-text-input :value="old('email')" autofocus class="block mt-1 w-full" id="email" name="email" required
					type="email" />
				<x-input-error :messages="$errors->get('email')" class="mt-2" />
			</div>

			<div class="flex items-center justify-end mt-4">
				<x-primary-button>
					{{ __('Email Password Reset Link') }}
				</x-primary-button>
			</div>
		</form>
	</div>
</x-guest-layout>
