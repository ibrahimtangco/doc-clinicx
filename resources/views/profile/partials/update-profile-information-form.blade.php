<section>
	<header>
		<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
			{{ __('Profile Information') }}
		</h2>

		<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
			{{ __("Update your account's profile information and email address.") }}
		</p>
	</header>

	<form action="{{ route('verification.send') }}" id="send-verification" method="post">
		@csrf
	</form>
	<form action="{{ route('profile.update') }}" class="mt-6 space-y-6" method="post">
		@csrf
		@method('patch')

		<x-form-edit-profile :user="$user" :provinces="$provinces" :cities="$cities" :barangays="$barangays" :modifiedAddress="$modifiedAddress" />

		<div class="flex items-center gap-4">
			<x-primary-button>{{ __('Save') }}</x-primary-button>

			@if (session('status') === 'profile-updated')
				<p class="text-sm text-gray-600 dark:text-gray-400" x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
					x-transition>{{ __('Saved.') }}</p>
			@endif
		</div>
	</form>
</section>
<script src="{{ asset('js/edit_profile_address_handler.js') }}"></script>
