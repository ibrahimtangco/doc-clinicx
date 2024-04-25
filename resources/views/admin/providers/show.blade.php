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
					<section class="space-y-4">
                        <h1 class="text-xl font-semibold">Name:
                            {{ $provider->title }}
                                    {{ $provider->user->first_name }}
                                    @if ($provider->user->middle_name)
                                        {{ strtoupper(substr($provider->user->middle_name, 0, 1)) . '.' }}
                                    @endif
                                    {{ $provider->user->last_name }}</h1>
                                    <p>Address: {{ $provider->user->address }}</p>
                                    <p>Email: {{ $provider->user->email }}</p>
                            <p>Specialization: {{ $provider->specialization }}</p>

					</section>

				</div>
			</div>
		</div>
	</div>
</x-admin>
