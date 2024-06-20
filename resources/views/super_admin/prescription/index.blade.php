<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('Prescriptions') }}

		</h2>
	</x-slot>

	{{-- main container --}}
	<div class="py-6">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			@if ($prescriptions->count() > 0)
				<div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
					@if (session('success'))
						<x-alert_success message="{{ session('success') }}" />
					@elseif (session('error'))
						<x-alert_error message="{{ session('error') }}" />
					@endif
					<div class="flex items-center justify-between w-full py-2">

						<table class="w-full text-sm text-left rtl:text-right text-gray-500">
							<thead class="text-xs text-gray-700 uppercase bg-gray-50">
								<tr>
									<th class="px-6 py-3" scope="col">Patient Name</th>
									<th class="px-6 py-3" scope="col">Medicines</th>
									<th class="px-6 py-3" scope="col">Quantities</th>
									<th class="px-6 py-3" scope="col">Dosages</th>
									<th class="px-6 py-3" scope="col"><span>Action</span></th>
								</tr>
							</thead>
							<tbody id="allData">
								@foreach ($prescriptions as $prescription)
									<tr class="bg-white border-b hover:bg-gray-50">

										<td class="px-6 py-4">{{ $prescription->patient->user->full_name }}</td>

										<td class="px-6 py-4 space-y-1">
											@foreach ($prescription->medicines as $medicine)
												<p>{{ $medicine }}</p>
											@endforeach
										</td>
										<td class="px-6 py-4 space-y-1">
											@foreach ($prescription->quantities as $quantity)
												<p>{{ $quantity }}</p>
											@endforeach
										</td>
										<td class="px-6 py-4 space-y-1">
											@foreach ($prescription->dosages as $dosage)
												<p>{{ $dosage }}</p>
											@endforeach
										</td>

										<td class="px-6 py-4 text-right gap-2 flex items-center">
											<a
												class="font-medium text-white bg-green-600 px-2 py-1 rounded hover:bg-green-700 flex items-center justify-center gap-1 w-fit"
												href="{{ route('superadmin.prescriptions.downloadPDF', ['prescription' => $prescription->id]) }}">
												<?xml version="1.0" ?><svg fill="currentColor" height="19" viewBox="0 0 512 512" width="19"
													xmlns="http://www.w3.org/2000/svg">
													<title />
													<g data-name="1" id="_1">
														<path
															d="M255.13,385.54a15,15,0,0,1-11.14-5L103.67,224.93a15,15,0,0,1,11.14-25H171V63a15,15,0,0,1,15-15H324.3a15,15,0,0,1,15,15V199.89h56.16a15,15,0,0,1,11.14,25L266.27,380.58A15,15,0,0,1,255.13,385.54ZM148.53,229.89l106.6,118.25L361.74,229.89H324.3a15,15,0,0,1-15-15V78H201V214.89a15,15,0,0,1-15,15Z" />
														<path
															d="M390.84,450H119.43a65.37,65.37,0,0,1-65.3-65.29V346.54a15,15,0,0,1,30,0v38.17A35.34,35.34,0,0,0,119.43,420H390.84a35.33,35.33,0,0,0,35.29-35.29V346.54a15,15,0,0,1,30,0v38.17A65.37,65.37,0,0,1,390.84,450Z" />
													</g>
												</svg>
												<span class="hidden md:block">Download</span>
											</a>
											<a
												class="font-medium text-white bg-blue-600 px-2 py-1 rounded hover:bg-blue-700 flex items-center justify-center gap-1 w-fit"
												href="{{ route('superadmin.prescriptions.previewPDF', ['prescription' => $prescription->id]) }}">
												<svg fill="none" height="15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													stroke="currentColor" viewBox="0 0 24 24" width="15" xmlns="http://www.w3.org/2000/svg">
													<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
													<path d="M12 9a3 3 0 1 0 0 6 3 3 0 1 0 0-6z"></path>
												</svg>
												<span>View</span>
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>

							<tbody id="searchData"></tbody>
						</table>
					</div>
				@else
					<div class="text-center text-xl text-text-desc">No Prescriptions Found</div>
			@endif

		</div>
	</div>

</x-app-layout>
