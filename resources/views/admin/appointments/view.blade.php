
<x-admin>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Appoinments') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="flex items-center justify-between w-full">
				<a class="hidden items-center gap-2 bg-primary text-white-text py-1 px-3 rounded-md"
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
                <div></div>
				<x-search id="searchPatient"/>
			</div>

    <table class="w-full text-sm text-left rtl:text-right text-secondary-text">
				<thead class="text-xs text-primary-text uppercase bg-gray-50 border-b font-semibold">
					<tr>
						<th class="px-6 py-3" scope="col">
							Patient Name
						</th>
						{{-- <th class="px-6 py-3 hidden sm:table-cell" scope="col">
							Provider
						</th> --}}
						<th class="px-6 py-3" scope="col">
							Procedure
						</th>
						<th class="px-6 py-3" scope="col">
							Date
						</th>
						<th class="px-6 py-3" scope="col">
							Time
						</th>
						<th class="px-6 py-3" scope="col">
							Action
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($appointments as $appointment)
                        <tr class="odd:bg-white even:bg-gray-100 border-b font-medium">
						<th class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap" scope="row">
							{{ $appointment->user->first_name }}
                            @if ($appointment->user->middle_name)
                                {{ ucfirst(substr($appointment->user->middle_name, 0, 1)) }}.
                            @endif
							{{ $appointment->user->last_name }}
						</th>
						{{-- <td class="px-6 py-4 hidden sm:table-cell">
							Dr. James Walter
						</td> --}}
						<td class="px-6 py-4">
							{{ $appointment->service->name }}
						</td>
						<td class="px-6 py-4">
							@php
                                $dateString = $appointment->date;
                                $date = new DateTime($dateString);
                                $formattedDate = $date->format('F j, Y');
                                echo $formattedDate;
                            @endphp
						</td>
						<td class="px-6 py-4">
							@php
                                $time = date('H:i:s', strtotime($appointment->time));
                                echo $time;
                            @endphp
						</td>

						<td class="px-6 py-4 flex flex-col gap-1 xl:block xl:space-x-1">
							<a class="font-medium text-center text-white text-[12px] hover:bg-blue-700 bg-blue-600 px-3 py-1 rounded"
								href="#">Done </a>
							<a class="font-medium text-center text-white text-[12px] hover:bg-red-700 bg-red-600 px-3 py-1 rounded"
								href="#">Reject</a>
						</td>
					</tr>
                    @endforeach

				</tbody>
			</table>
            <div class="mt-4">
                    {{ $appointments->links('pagination::tailwind') }}
                </div>
    <script src="{{ asset('js/filter.js') }}"></script>
</x-admin>
