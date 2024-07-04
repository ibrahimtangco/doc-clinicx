<x-app-layout>
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
			{{-- TODO: <x-search id="searchPatient"/> --}}
		</div>
		<div class="md:flex items-end gap-4 mt-8 space-y-4 md:space-y-0 px-2 md:px-0">
			<div class="w-full flex items-end justify-between">
                <div class="flex max-w-md  flex-col gap-2 w-full">
				<label for="filter-by-date">Filter By Date</label>
				<div class="flex items-center gap-2">
					<x-text-input class="border-gray-300 rounded-md w-full" id="filter-by-date" name="filter-by-date" type="date" />
					<x-primary-button class="py-2.5" onclick="location.reload()">reset</x-primary-button>
				</div>
			</div>
            @if (request()->routeIs('superadmin.appointments.view'))
                <a href="{{ route('superadmin.appointments.history') }}" class="px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-background-hover focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">View history</a>
            @endif
            </div>

		</div>
		<table class="w-full text-sm text-left rtl:text-right text-secondary-text mt-4 mb-8">
			<thead class="text-xs text-primary-text uppercase bg-gray-50 border-b font-semibold">
				<tr>
					<th class="px-6 py-3" scope="col">
						Patient Name
					</th>
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
						Status
					</th>
					<th class="px-6 py-3" scope="col">
						Action
					</th>
				</tr>
			</thead>
			<tbody class="all-appointments">
				@foreach ($appointments as $appointment)
					<tr class="odd:bg-white even:bg-gray-100 border-b font-medium">
						<th class="px-6 py-3 font-semibold text-gray-900 whitespace-nowrap" scope="row">
							{{ $appointment->user->full_name }}
						</th>
						<td class="px-6 py-3">
							{{ $appointment->service->name }}
						</td>
						<td class="px-6 py-3">
							{{ $appointment->formatted_date }}
						</td>
						<td class="px-6 py-3">
							{{ $appointment->formatted_time }}
						</td>
						<td class="px-6 py-3 font-semibold">
							@if ($appointment->status == 'booked')
								<span class="text-yellow-500 px-2 py-0.5 rounded-full">{{ Str::ucfirst($appointment->status) }}</span>
							@elseif ($appointment->status == 'cancelled')
								<span class="text-red-500 px-2 py-0.5 rounded-full">{{ Str::ucfirst($appointment->status) }}</span>
							@elseif ($appointment->status == 'completed')
								<span class="text-green-500 px-2 py-0.5 rounded-full">{{ Str::ucfirst($appointment->status) }}</span>
							@endif
						</td>
						<td class="px-6 py-3 flex flex-col gap-1 xl:block xl:space-x-1">
							<a
								class="font-medium text-white bg-blue-600 px-2 py-1 rounded hover:bg-blue-700 flex items-center justify-center gap-1 w-fit"
								href="{{ route('superadmin.edit-appointment', $appointment->id) }}">
								<?xml version="1.0" ?><svg height="15px" version="1.1" viewBox="0 0 18 18" width="15px"
									xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" xmlns:xlink="http://www.w3.org/1999/xlink"
									xmlns="http://www.w3.org/2000/svg">
									<title />
									<desc />
									<defs />
									<g fill-rule="evenodd" fill="none" id="Page-1" stroke-width="1" stroke="none">
										<g fill="currentColor" id="Core" transform="translate(-213.000000, -129.000000)">
											<g id="create" transform="translate(213.000000, 129.000000)">
												<path
													d="M0,14.2 L0,18 L3.8,18 L14.8,6.9 L11,3.1 L0,14.2 L0,14.2 Z M17.7,4 C18.1,3.6 18.1,3 17.7,2.6 L15.4,0.3 C15,-0.1 14.4,-0.1 14,0.3 L12.2,2.1 L16,5.9 L17.7,4 L17.7,4 Z"
													id="Shape" />
											</g>
										</g>
									</g>
								</svg>
								<span>View</span>
							</a>

						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div class="text-center error-container"></div>
		<div class="mt-4" id="paginate">
			{{ $appointments->links('pagination::tailwind') }}
		</div>

		<script src="{{ asset('js/filterByStatus.js') }}"></script>
		<script src="{{ asset('js/filterByDate.js') }}"></script>
</x-app-layout>
