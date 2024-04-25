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
						<form action="{{ route('providers.update', ['provider' => $provider->id]) }}" class="mt-6 space-y-6"
							enctype="multipart/form-data" method="post">
							@csrf
							@method('PUT')

							{{-- <div>
								<img alt="" class="w-12 h-12 rounded-full object-cover mb-4 border-2 border-gray-400"
									src="{{ asset($provider->avatar) }}">
								<x-input-label :value="__('Avatar')" for="avatar" />
								<div class="border border-gray-300 p-1 mt-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
									<x-text-input autocomplete="avatar" autofocus class="rounded-none block w-full shadow-none border-0"
										id="avatar" name="avatar" type="file" />
								</div>
								<x-input-error :messages="$errors->get('title')" class="mt-2" />
							</div> --}}
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
									<x-text-input :value="$provider->user->first_name" autocomplete="first_name" autofocus class="mt-1 block w-full" id="first_name"
										name="first_name" type="text" />
									<x-input-error :messages="$errors->get('first_name')" class="mt-2" />
								</div>

								<div>
									<x-input-label :value="__('Middle Name')" for="middle_name" />
									<x-text-input :value="old('middle_name')" :value="$provider->user->middle_name" autocomplete="middle_name" autofocus
										class="mt-1 block w-full" id="middle_name" name="middle_name" type="text" />
									<x-input-error :messages="$errors->get('middle_name')" class="mt-2" />
								</div>

								<div>
									<x-input-label :value="__('Last Name')" for="last_name" />
									<x-text-input :value="old('last_name')" :value="$provider->user->last_name" autocomplete="last_name" autofocus
										class="mt-1 block w-full" id="last_name" name="last_name" type="text" />
									<x-input-error :messages="$errors->get('last_name')" class="mt-2" />
								</div>
							</div>

							<div class="mt-4">
								<x-input-label :value="__('Specialization')" for="specialization" />
								<select
									class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1 block"
									id="" name="specialization">
									<option value="">Select Specialization</option>
									<option {{ $provider->specialization == 'Orthodontics' ? 'selected' : '' }} value="Orthodontics">Orthodontics
									</option>
									<option {{ $provider->specialization == 'Endodontics' ? 'selected' : '' }} value="Endodontics">Endodontics
									</option>
									<option {{ $provider->specialization == 'Periodontics' ? 'selected' : '' }} value="Periodontics">Periodontics
									</option>
								</select>
								<x-input-error :messages="$errors->get('specialization')" class="mt-2" />
							</div>

							<div>
								<x-input-label :value="__('Address')" for="address" />
								<x-text-input :value="old('address')" :value="$provider->user->address" autocomplete="address" autofocus class="block mt-1 w-full"
									id="address" name="address" type="text" />
								<x-input-error :messages="$errors->get('address')" class="mt-2" />
							</div>
							<input name="userType" type="hidden" value="SuperAdmin">
							<div class="mt-4">
								<x-input-label :value="__('Email')" for="email" />
								<x-text-input :value="old('email')" :value="$provider->user->email" autocomplete="username" class="block mt-1 w-full"
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
