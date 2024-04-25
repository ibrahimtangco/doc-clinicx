<x-admin>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('Services') }}
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
								{{ __('Edit Service Information') }}
							</h2>

							<p class="mt-1 text-sm text-gray-600">
								{{ __('Fill in the required details to add a new service provider to offer.') }}
							</p>
						</header>

						<form action="{{ route('services.update', ['service' => $service->id]) }}" class="mt-6 space-y-6" method="post" enctype="multipart/form-data">
							@csrf
                            @method('PUT')

							<div class="mt-4">
								<x-input-label :value="__('Name')" for="name" />
								<x-text-input :value="old('name')" autocomplete="name" autofocus class="block mt-1 w-full" id="name"
									name="name" type="text" :value="$service->name"/>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
							</div>

							<div>
								<x-input-label :value="__('Price in Peso')" for="price" />
                                <x-text-input :value="old('price')" autocomplete="price" autofocus class="block mt-1 w-full" id="price"
									name="price" type="text" :value="$service->price"/>
								<x-input-error :messages="$errors->get('price')" class="mt-2" />
							</div>

                            <div>
								<x-input-label :value="__('Duration in Minutes')" for="duration" />
                                <x-text-input :value="old('duration')" autocomplete="duration" autofocus class="block mt-1 w-full" id="duration"
									name="duration" type="text" :value="$service->duration"/>
								<x-input-error :messages="$errors->get('price')" class="mt-2" />
							</div>

							<div class="mt-4">
								<x-input-label :value="__('Description')" for="email" />
								<textarea name="description" id="description" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1">{{ $service->description }}</textarea>
								<x-input-error :messages="$errors->get('email')" class="mt-2" />
							</div>

                            <div class="mt-4">
								<x-input-label :value="__('Is Available')" for="availability" />
								<input type="checkbox" name="availability" {{ $service->availability == true ? 'checked' : '' }} class="rounded border-gray-300"/>
								<x-input-error :messages="$errors->get('availability')" class="mt-2" />
							</div>

							<div class="flex items-center gap-4">
								<x-primary-button>{{ __('Edit') }}</x-primary-button>

							</div>
						</form>
					</section>

				</div>
			</div>
		</div>
	</div>
</x-admin>
