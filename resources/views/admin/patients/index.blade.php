<x-admin>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('Patients') }}

		</h2>
	</x-slot>

	{{-- main container --}}

	<div class="py-6">

		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="flex items-center justify-between w-full">
				<a class="flex items-center gap-2 bg-primary text-white-text py-1 px-3 rounded-md"
					href="{{ route('patients.create') }}">
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
				<x-search id="searchPatient"/>
			</div>
			@if (session('message'))
				<x-alert>
					{{ session('message') }}
				</x-alert>
			@endif
			@if ($patients->count() > 0)
				<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
					<table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <div id="all">
						<thead class="text-xs text-gray-700 uppercase bg-gray-50">
							<tr>
								<th class="px-6 py-3" scope="col">First Name</th>
								<th class="px-6 py-3" scope="col">Middle Name</th>
								<th class="px-6 py-3" scope="col">Last Name</th>
								<th class="px-6 py-3" scope="col">Address</th>
								<th class="px-6 py-3" scope="col">Email</th>
								<th class="px-6 py-3" scope="col"><span class="sr-only">Action</span></th>
							</tr>
						</thead>
						<tbody id="allData">
							@foreach ($patients as $patient)
								<tr class="bg-white border-b hover:bg-gray-50">
									<td class="px-6 py-4">{{ $patient->user->first_name }}</td>
									<td class="px-6 py-4">{{ $patient->user->middle_name }}</td>
									<td class="px-6 py-4">{{ $patient->user->last_name }}</td>
									<td class="px-6 py-4">{{ $patient->user->address }}</td>
									<td class="px-6 py-4">{{ $patient->user->email }}</td>
									<td class="px-6 py-4 text-right space-x-2 flex items-center">
                                        <a class="font-medium text-white bg-blue-600 px-2 py-1 rounded hover:bg-blue-700 flex items-center justify-center gap-1 w-fit"
											href="{{ route('show.patient.record', ['patient' => $patient->id]) }}">
                                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <path d="M12 9a3 3 0 1 0 0 6 3 3 0 1 0 0-6z"></path>
                                            </svg>
                                            <span>View</span>
                                        </a>
										<a class="font-medium text-white bg-orange-600 px-2 py-1 rounded hover:bg-orange-700 flex items-center justify-center gap-1 w-fit"
											href="{{ route('patients.edit', ['patient' => $patient->id]) }}">
                                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        <span>Edit</span>
                                        </a>

									</td>
								</tr>
							@endforeach
						</tbody>

						<tbody id="searchData">

						</tbody>

					</table>

				</div>
                <div class="mt-4">
                    {{ $patients->links('pagination::tailwind') }}
                </div>
			@else
				<div class="text-center text-xl text-text-desc">No patients Found</div>
			@endif

		</div>
	</div>

<script>

// search
        $('#searchPatient').on('keyup', function() {

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
            url:'{{ URL::to('admin/patient/search') }}',
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
