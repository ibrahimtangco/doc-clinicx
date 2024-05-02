<x-admin>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('Providers') }}

		</h2>
	</x-slot>

	{{-- main container --}}
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex items-center justify-between w-full px-4">
				<a class="flex items-center gap-2 bg-primary text-white-text py-1 px-3 rounded-md"
					href="{{ route('providers.create') }}">
					<?xml version="1.0" ?><svg height="20" viewBox="0 0 32 32" width="20" xmlns="http://www.w3.org/2000/svg">
						<defs>
							<style>
								.cls-1 {
									fill: none;
									stroke: #fff;
									stroke-linecap: round;
									stroke-linejoin: round;
									stroke-width: 3px;
								}
							</style>
						</defs>
						<title />
						<g id="plus">
							<line class="cls-1" x1="16" x2="16" y1="7" y2="25" />
							<line class="cls-1" x1="7" x2="25" y1="16" y2="16" />
						</g>
					</svg> {{ __('Add') }}
				</a>
				<x-search id="searchDentist"/>
			</div>
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
								<th class="px-6 py-3" scope="col">Name</th>
								<th class="px-6 py-3" scope="col">Specialization</th>
								<th class="px-6 py-3" scope="col">Email</th>
								<th class="px-6 py-3" scope="col"><span class="sr-only">Action</span></th>
							</tr>
						</thead>
						<tbody id="allData">
							@foreach ($providers as $provider)
								<tr class="bg-white border-b hover:bg-gray-50">

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
											<button class="font-medium text-red-600" type="submit" onclick="return confirm(`Are you sure you want to delete {{ $provider->user->first_name }} {{ $provider->user->last_name }}'s record?`)">Delete</button>
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
                        <tbody id="searchData"></tbody>
					</table>
				</div>
			@else
				<div class="text-center text-xl text-text-desc">No Providers Found</div>
			@endif

		</div>
	</div>

    <script>

// search
        $('#searchDentist').on('keyup', function() {

		$searchValue = $(this).val();

        if($searchValue !== ''){
            $('#searchData').show();
            $('#allData').hide();
        }
        else {
            $('#searchData').hide();
            $('#allData').show();
        }

        $.ajax({
            type:'get',
            url:'{{ URL::to('admin/provider/search') }}',
            data: {'search':$searchValue},

            success:function(data) {
                    $('#searchData').html(data);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
	});

    </script>
</x-admin>
