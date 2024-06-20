<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			<a href="{{ route('prescriptions.index') }}">{{ __('Prescription') }}</a>
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<div class="">
					<section>
						<header>
							<h2 class="text-lg font-medium text-gray-900">
								{{ __('Add Prescription') }}
							</h2>

							<p class="mt-1 text-sm text-gray-600">
								{{ __('Fill in the required details to add a prescription for patient.') }}
							</p>
						</header>

						<form action="{{ route('prescriptions.store') }}" class="mt-6 space-y-6" id="myForm" method="post">
							@csrf

							<table class="w-full text-sm text-left rtl:text-right text-gray-500">
								<thead class="text-xs text-gray-700 uppercase bg-gray-50 border">
									<tr>
										<th class="px-6 py-3" scope="col">Medicine Name</th>
										<th class="px-6 py-3" scope="col">Quantity (pcs)</th>
										<th class="px-6 py-3" scope="col">Dosage</th>
										<th class="px-6 py-3" scope="col">Action</th>
									</tr>
								</thead>
								<tbody id="tbody">
									<input class="hidden" name="patient_id" type="text" value="{{ $patient->id }}">
									<tr class="mt-2">
										<td class="mt-4 p-2 border">
											<x-text-input :value="old('inputs.0.medicine_name')" autocomplete="medicine_name" autofocus class="block mt-1 w-full"
												id="medicine_name" name="inputs[0][medicine_name]" placeholder="Medicine Name" type="text" />
											<x-input-error :messages="$errors->get('inputs.0.medicine_name')" class="mt-2" />
										</td>

										<td class="mt-4 p-2 border">
											<x-text-input :value="old('inputs.0.quantity')" autocomplete="quantity" autofocus class="block mt-1 w-full" id="quantity"
												name="inputs[0][quantity]" placeholder="Quantity (pcs)" type="number" />
											<x-input-error :messages="$errors->get('inputs.0.quantity')" class="mt-2" />
										</td>

										<td class="mt-4 p-2 border">
											<x-text-input :value="old('inputs.0.dosage')" autocomplete="dosage" autofocus class="block mt-1 w-full" id="dosage"
												name="inputs[0][dosage]" placeholder="Dosage" type="text" />
											<x-input-error :messages="$errors->get('inputs.0.dosage')" class="mt-2" />
										</td>
										<td class="mt-4 p-2 border">
											<button
												class="add-row text-white bg-blue-600 hover:bg-blue-700 py-2 border border-blue-600 rounded block mt-1 w-full uppercase font-semibold"
												type="button">Add</button>
										</td>
									</tr>
								</tbody>
							</table>

							<div class="flex items-center gap-4">
								<x-primary-button id="open-modal">{{ __('Create') }}</x-primary-button>
							</div>
						</form>
					</section>
				</div>
			</div>
		</div>
	</div>
	<script>
		var i = 1;

		$('.add-row').click(function() {
			$('#tbody').append(
				`<tr class="mt-2">
                    <td class="mt-4 p-2 border">
                        <x-text-input :value="old('inputs.${i}.medicine_name')" autocomplete="medicine_name" autofocus class="block mt-1 w-full"
                            id="medicine_name" name="inputs[${i}][medicine_name]" type="text" placeholder="Medicine Name"/>
                        <x-input-error :messages="$errors->get('inputs.${i}.medicine_name')" class="mt-2" />
                    </td>

                    <td class="mt-4 p-2 border">
                        <x-text-input :value="old('inputs.${i}.quantity')" autocomplete="quantity" autofocus class="block mt-1 w-full" id="quantity"
                            name="inputs[${i}][quantity]" type="number" placeholder="Quantity (pcs)"/>
                        <x-input-error :messages="$errors->get('inputs.${i}.quantity')" class="mt-2" />
                    </td>

                    <td class="mt-4 p-2 border">
                        <x-text-input :value="old('inputs.${i}.dosage')" autocomplete="dosage" autofocus class="block mt-1 w-full" id="dosage"
                            name="inputs[${i}][dosage]" type="text" placeholder="Dosage"/>
                        <x-input-error :messages="$errors->get('inputs.${i}.dosage')" class="mt-2" />
                    </td>

                    <td class="mt-4 p-2 border">
                        <button type="button" class="remove text-white bg-red-600 hover:bg-red-700 py-2 border border-red-600 rounded block mt-1 w-full uppercase font-semibold">Remove</button>
                    </td>
                </tr>`
			);
			i++;
		});

		$('#tbody').on('click', '.remove', function() {
			$(this).closest('tr').remove();
		});
	</script>
</x-app-layout>
