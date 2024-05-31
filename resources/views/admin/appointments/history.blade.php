<x-admin>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('Appoinments History') }}
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
		</div>
		<div class="md:flex items-center gap-4 mt-8 space-y-4 md:space-y-0 px-2 md:px-0">
			<div class="flex flex-col gap-2 w-full max-w-md">
				<label for="status">Filter By Status</label>
				<select class="border-gray-300 rounded-md " id="status" name="status">
					<option value="">Show All</option>
					<option class="text-green-500" value="completed">Show Completed</option>
					<option class="text-red-500" value="cancelled">Show Cancelled</option>
				</select>
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
							{{ $appointment->user->first_name }}
							@if ($appointment->user->middle_name)
								{{ ucfirst(substr($appointment->user->middle_name, 0, 1)) }}.
							@endif
							{{ $appointment->user->last_name }}
						</th>
						<td class="px-6 py-3">
							{{ $appointment->service->name }}
						</td>
						<td class="px-6 py-3">
							@php
								$dateString = $appointment->date;
								$date = new DateTime($dateString);
								$formattedDate = $date->format('F j, Y');
								echo $formattedDate;
							@endphp
						</td>
						<td class="px-6 py-3">
							@php
								$time = date('g:i A', strtotime($appointment->time));
								echo $time;
							@endphp
						</td>
						<td class="px-6 py-3 font-semibold">

							@if ($appointment->status == 'cancelled')
								<span class="text-red-500 px-2 py-0.5 rounded-full">{{ Str::ucfirst($appointment->status) }}</span>
							@elseif ($appointment->status == 'completed')
								<span class="text-green-500 px-2 py-0.5 rounded-full">{{ Str::ucfirst($appointment->status) }}</span>
							@endif

						</td>
						<td class="px-6 py-3 flex flex-col gap-1 xl:block xl:space-x-1">
							<a
								class="font-medium text-center text-white hover:bg-blue-700 bg-blue-600 px-3 py-1 rounded-lg flex items-center justify-center gap-1 w-fit"
								href="{{ route('edit-appointment', $appointment->id) }}">
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
            <div class="error-container"></div>

		</table>
		<div class="mt-4">
			{{ $appointments->links('pagination::tailwind') }}
		</div>

		<script src="{{ asset('js/filterByStatus.js') }}"></script>
        <script src="{{ asset('js/filterByDate.js') }}"></script>
</x-admin>
