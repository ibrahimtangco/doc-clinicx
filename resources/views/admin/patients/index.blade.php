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
            <a href="{{ route('patients.create') }}" class="flex items-center gap-2 bg-primary text-white-text py-1 px-3 rounded-md"><?xml version="1.0" ?><svg viewBox="0 0 32 32" width="20" height="20 xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:3px;}</style></defs><title/><g id="plus"><line class="cls-1" x1="16" x2="16" y1="7" y2="25"/><line class="cls-1" x1="7" x2="25" y1="16" y2="16"/></g></svg> {{ __('Add') }}</a>
             <x-search resource="asd"/>
           </div>
			@if (session('message'))
				<x-alert>
					{{ session('message') }}
				</x-alert>
			@endif
			@if ($patients->count() > 0)
				<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
					<table class="w-full text-sm text-left rtl:text-right text-gray-500">
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
						<tbody>
							@foreach ($patients as $patient)
								<tr class="bg-white border-b hover:bg-gray-50">
									<td class="px-6 py-4">{{ $patient->first_name }}</td>
									<td class="px-6 py-4">{{ $patient->middle_name }}</td>
									<td class="px-6 py-4">{{ $patient->last_name }}</td>
									<td class="px-6 py-4">{{ $patient->address }}</td>
									<td class="px-6 py-4">{{ $patient->email }}</td>
									<td class="px-6 py-4 text-right space-x-2 flex items-center">
										<a class="font-medium text-white bg-blue-600 px-2 py-1 rounded hover:bg-blue-700"
											href="{{ route('patients.edit', ['patient' => $patient->id]) }}">Edit</a>
										<form action="{{ route('patients.destroy', ['patient' => $patient->id]) }}" method="post">
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
				<div class="text-center text-xl text-text-desc">No patients Found</div>
			@endif

		</div>
	</div>
</x-admin>
