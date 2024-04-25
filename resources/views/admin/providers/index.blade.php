<x-admin>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('Providers') }}

		</h2>
	</x-slot>

	{{-- main container --}}
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
			@if (session('message'))
				<x-alert>
					{{ session('message') }}
				</x-alert>
			@endif
			@if ($providers->count() > 0)
				<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
					<table class="w-full text-sm text-left rtl:text-right text-gray-500">
						<thead class="text-xs text-gray-700 uppercase bg-gray-50">
							<tr>
								<th class="px-6 py-3" scope="col">Avatar</th>
								<th class="px-6 py-3" scope="col">Name</th>
								<th class="px-6 py-3" scope="col">Specialization</th>
								<th class="px-6 py-3" scope="col">Email</th>
								<th class="px-6 py-3" scope="col"><span class="sr-only">Edit</span></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($providers as $provider)
								<tr class="bg-white border-b hover:bg-gray-50">
									<td class="px-6 py-4">
										<img alt="" class="w-12 h-12 object-cover rounded-full"
											src="{{ asset($provider->avatar) }}">
									</td>
									<td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap" scope="row">
										<a href="{{ route('providers.show', ['provider' => $provider->id]) }}">
											{{ $provider->title }}
											{{ $provider->user->first_name }}
											@if ($provider->user->middle_name)
												{{ strtoupper(substr($provider->user->middle_name, 0, 1)) . '.' }}
											@endif
											{{ $provider->user->last_name }}
										</a>
									</td>
									<td class="px-6 py-4">{{ $provider->specialization }}</td>
									<td class="px-6 py-4">{{ $provider->user->email }}</td>
									<td class="px-6 py-4 text-right space-x-2 flex items-center">
										<a class="font-medium text-white bg-blue-600 px-2 py-1 rounded hover:bg-blue-700"
											href="{{ route('providers.edit', ['provider' => $provider->id]) }}">Edit</a>
										<form action="{{ route('providers.destroy', ['provider' => $provider->id]) }}" method="post">
											@csrf
											@method('DELETE')
											<button class="font-medium text-red-600" type="submit">Delete</button>
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@else
				<div class="text-center text-xl text-text-desc">No Providers Found</div>
			@endif

		</div>
	</div>
</x-admin>
