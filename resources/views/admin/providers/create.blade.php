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
							<h2 class="text-lg font-medium text-gray-900">
								{{ __('Add Service Provider') }}
							</h2>

							<p class="mt-1 text-sm text-gray-600">
								{{ __('Fill in the required details and credentials to add a new service provider to the system.') }}
							</p>
						</header>

						<form action="{{ route('providers.store') }}" class="mt-6 space-y-6" method="post" enctype="multipart/form-data">
							@csrf

                            <div>
								<x-input-label :value="__('Avatar')" for="avatar" />
                                <div class="border border-gray-300 p-1 mt-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <x-text-input autocomplete="avatar" autofocus class="rounded-none block w-full shadow-none border-0" id="avatar" name="avatar"
										type="file" />
                                </div>
								<x-input-error :messages="$errors->get('title')" class="mt-2" />
							</div>
							<div>
								<x-input-label :value="__('Title')" for="title" />
								<select
									class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1 block"
									id="title" name="title">
									<option value="Dr.">Dr</option>
								</select>
								<x-input-error :messages="$errors->get('title')" class="mt-2" />
							</div>

							<div class="flex items-center gap-2">
								<div>
									<x-input-label :value="__('First Name')" for="first_name" />
									<x-text-input autocomplete="first_name" autofocus class="mt-1 block w-full" id="first_name" name="first_name" :value="old('first_name')"
										type="text" />
									<x-input-error :messages="$errors->get('first_name')" class="mt-2" />
								</div>

								<div>
									<x-input-label :value="__('Middle Name')" for="middle_name" />
									<x-text-input autocomplete="middle_name" autofocus class="mt-1 block w-full" id="middle_name" :value="old('middle_name')"
										name="middle_name" type="text" />
									<x-input-error :messages="$errors->get('middle_name')" class="mt-2" />
								</div>

								<div>
									<x-input-label :value="__('Last Name')" for="last_name" />
									<x-text-input autocomplete="last_name" autofocus class="mt-1 block w-full" id="last_name" name="last_name" :value="old('last_name')"
										type="text" />
									<x-input-error :messages="$errors->get('last_name')" class="mt-2" />
								</div>
							</div>

							<div class="mt-4">
								<x-input-label :value="__('Specialization')" for="specialization" />
								<select
									class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1 block"
									id="" name="specialization">
									<option value="">Select Specialization</option>
									<option value="Orthodontics">Orthodontics</option>
									<option value="Endodontics">Endodontics</option>
									<option value="Periodontics">Periodontics</option>
								</select>
                                <x-input-error :messages="$errors->get('specialization')" class="mt-2" />
							</div>

							<div>
								<x-input-label :value="__('Address')" for="address" />
								<x-text-input :value="old('address')" autocomplete="address" autofocus class="block mt-1 w-full" id="address"
									name="address" type="text" />
								<x-input-error :messages="$errors->get('address')" class="mt-2" />
							</div>
                            <input type="hidden" name="userType" value="SuperAdmin">
							<div class="mt-4">
								<x-input-label :value="__('Email')" for="email" />
								<x-text-input :value="old('email')" autocomplete="username" class="block mt-1 w-full" id="email" name="email"
									type="email" />
								<x-input-error :messages="$errors->get('email')" class="mt-2" />
							</div>

							<!-- Password -->
							<div class="mt-4">
								<x-input-label :value="__('Password')" for="password" />

								<x-text-input autocomplete="new-password" class="block mt-1 w-full" id="password" name="password"
									type="password" />

								<x-input-error :messages="$errors->get('password')" class="mt-2" />
							</div>

							<!-- Confirm Password -->
							<div class="mt-4">
								<x-input-label :value="__('Confirm Password')" for="password_confirmation" />

								<x-text-input autocomplete="new-password" class="block mt-1 w-full" id="password_confirmation"
									name="password_confirmation" type="password" />

								<x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
							</div>

							<div class="flex items-center gap-4">
								<x-primary-button>{{ __('Create') }}</x-primary-button>

							</div>
						</form>
					</section>

				</div>
			</div>
		</div>
	</div>
</x-admin>
