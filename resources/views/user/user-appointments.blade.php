<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('My Appointments') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

			<table class="w-full text-sm text-left rtl:text-right text-secondary-text mb-8">
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
				<tbody >
					@foreach ($appointments as $appointment)
						<tr class="odd:bg-white even:bg-gray-100 border-b font-medium ">
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
								@if ($appointment->status == 'booked')
									<span class="text-yellow-500 px-2 py-0.5 rounded-full">{{ Str::ucfirst($appointment->status) }}</span>
								@elseif ($appointment->status == 'cancelled')
									<span class="text-red-500 px-2 py-0.5 rounded-full">{{ Str::ucfirst($appointment->status) }}</span>
								@elseif ($appointment->status == 'completed')
									<span class="text-green-500 px-2 py-0.5 rounded-full">{{ Str::ucfirst($appointment->status) }}</span>
								@endif
							</td>
							<td class="px-6 py-3 flex flex-col gap-1 xl:block xl:space-x-1">
                                <a href="{{ route('show-appointment', $appointment) }}" class="font-medium text-white bg-blue-600 px-2 py-1 rounded hover:bg-blue-700" type="submit">View</a>

								@if ($appointment->status != 'cancelled')
									@if ($appointment->canBeCancelled())
										<form action="{{ route('user.appointment.cancel', $appointment->id) }}" method="POST" class="inline" id="cancelForm">
											@csrf
											<button class="font-medium text-white bg-red-600 px-2 py-1 rounded hover:bg-red-700" type="submit">Cancel</button>
										</form>
									@else
										<button class="font-medium text-white bg-gray-300 px-2 py-1 rounded" disabled type="submit">Cancel</button>
									@endif
								@else
									<button class="font-medium text-white bg-gray-300 px-2 py-1 rounded" disabled type="submit">Cancel</button>
								@endif

							</td>
						</tr>
					@endforeach

				</tbody>
			</table>
			<div class="mt-4">
				{{ $appointments->links('pagination::tailwind') }}
			</div>
		</div>
	</div>
</x-app-layout>
