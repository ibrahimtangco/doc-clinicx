<x-admin-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			<a href="{{ route('providers.index') }}">{{ __('Providers') }}</a>
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
								{{ __('Edit Provider Information') }}
							</h2>

							<p class="mt-1 text-sm text-gray-600">
								{{ __('Update providers information.') }}
							</p>
						</header>
						<form action="{{ route('providers.update', ['provider' => $user->id]) }}" class="mt-6 space-y-6"
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
							<x-form-edit :barangays="$barangays" :cities="$cities" :modifiedAddress="$modifiedAddress" :provinces="$provinces" :user="$user" />

							<div class="flex items-center gap-4">
								<x-primary-button>{{ __('Update') }}</x-primary-button>

							</div>
						</form>
					</section>

				</div>
			</div>
		</div>
	</div>
</x-admin-layout>
