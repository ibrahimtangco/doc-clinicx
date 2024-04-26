<x-admin>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('Providers') }}
		</h2>
	</x-slot>

	{{-- main container --}}
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<div class="max-w-xl">
					<section>
						<header>
							@if (session('message'))
								<x-alert>
									{{ session('message') }}
								</x-alert>
							@endif
							<h2 class="text-lg font-medium text-gray-900">
								{{ __('Edit Provider Information') }}
							</h2>

							<p class="mt-1 text-sm text-gray-600">
								{{ __('Update providers information.') }}
							</p>
						</header>
						<form action="{{ route('patients.update', ['patient' => $patient->id]) }}" class="mt-6 space-y-6" method="post">
							@csrf
							@method('PUT')

							<div class="flex items-center gap-2">
								<div>
									<x-input-label :value="__('First Name')" for="first_name" />
									<x-text-input :value="$patient->first_name" autocomplete="first_name" autofocus class="mt-1 block w-full" id="first_name"
										name="first_name" type="text" />
									<x-input-error :messages="$errors->get('first_name')" class="mt-2" />
								</div>

								<div>
									<x-input-label :value="__('Middle Name')" for="middle_name" />
									<x-text-input :value="old('middle_name')" :value="$patient->middle_name" autocomplete="middle_name" autofocus
										class="mt-1 block w-full" id="middle_name" name="middle_name" type="text" />
									<x-input-error :messages="$errors->get('middle_name')" class="mt-2" />
								</div>

								<div>
									<x-input-label :value="__('Last Name')" for="last_name" />
									<x-text-input :value="old('last_name')" :value="$patient->last_name" autocomplete="last_name" autofocus
										class="mt-1 block w-full" id="last_name" name="last_name" type="text" />
									<x-input-error :messages="$errors->get('last_name')" class="mt-2" />
								</div>
							</div>


							<div>
								<x-input-label :value="__('Address')" for="address" />
								<x-text-input :value="old('address')" :value="$patient->address" autocomplete="address" autofocus class="block mt-1 w-full"
									id="address" name="address" type="text" />
								<x-input-error :messages="$errors->get('address')" class="mt-2" />
							</div>
							<input name="userType" type="hidden" value="SuperAdmin">
							<div class="mt-4">
								<x-input-label :value="__('Email')" for="email" />
								<x-text-input :value="old('email')" :value="$patient->email" autocomplete="username" class="block mt-1 w-full"
									id="email" name="email" type="email" />
								<x-input-error :messages="$errors->get('email')" class="mt-2" />
							</div>

							<div class="flex items-center gap-4">
								<x-primary-button>{{ __('Update') }}</x-primary-button>

							</div>
						</form>
					</section>

				</div>
			</div>
		</div>
	</div>
</x-admin>
