
<x-admin>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Patients Information') }}
        </h2>
    </x-slot>

    <table class="w-full text-sm text-left rtl:text-right text-secondary-text">
				<thead class="text-xs text-primary-text uppercase bg-gray-50 border-b font-semibold">
					<tr>
						<th class="px-6 py-3" scope="col">
							First Name
						</th>
						<th class="px-6 py-3 hidden sm:table-cell" scope="col">
							Middle Name
						</th>
						<th class="px-6 py-3" scope="col">
							Last Name
						</th>
						<th class="px-6 py-3" scope="col">
							Address
						</th>
						<th class="px-6 py-3" scope="col">
							Email
						</th>
                        <th class="px-6 py-3" scope="col"><span class="sr-only">Action</span></th>
					</tr>
				</thead>
				<tbody>

                    @foreach ($patients as $patient)
                        <tr class="odd:bg-white even:bg-gray-100 border-b font-medium">
						<th class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap" scope="row">
							{{ $patient->first_name }}
						</th>
						<td class="px-6 py-4 hidden sm:table-cell">
							{{ $patient->middle_name }}
						</td>
						<td class="px-6 py-4">
							{{ $patient->last_name }}
						</td>
						<td class="px-6 py-4">
							{{ $patient->address }}
						</td>
						<td class="px-6 py-4">
							{{ $patient->email }}
						</td>
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
</x-admin>
