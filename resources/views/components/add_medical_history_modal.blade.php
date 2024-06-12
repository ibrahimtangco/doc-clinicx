@props([
    'patientId'
])

<div
id="add-medical-history-modal"
	class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/50 backdrop-blur-sm">
	<div class="relative p-4 w-full max-w-2xl max-h-full">
		<!-- Modal content -->
		<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
			<!-- Modal header -->
			<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
				<h3 class="text-xl font-semibold text-gray-900 dark:text-white">
					Add Medical History
				</h3>
				<button id="add-medical-history-close-btn"
					class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
					data-modal-hide="default-modal" type="button">
					<svg aria-hidden="true" class="w-3 h-3" fill="none" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<path d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							stroke="currentColor" />
					</svg>
					<span class="sr-only">Close modal</span>
				</button>
			</div>
			<!-- Modal body -->
			<div class="p-4 md:p-5 space-y-4">
				<form action="{{ route('add.medical.history') }}" class="space-y-2" method="POST">
					@csrf
                    <input type="text" class="hidden" name="patient_id" id="" value="{{ $patientId }}">
					<div class="w-full">
						<x-input-label :value="__('Condition')" for="condition" />
						<x-text-input :value="old('condition')" autofocus class="mt-1 w-full" id="condition" name="condition" type="text" />
						<x-input-error :messages="$errors->get('condition')" class="mt-2" />
					</div>
					<div class="w-full">
						<x-input-label :value="__('Diagnosed Date')" for="diagnosed_date" />
						<x-text-input :value="old('diagnosed_date')" autofocus class="mt-1 w-full" id="diagnosed_date" name="diagnosed_date"
							type="date" />
						<x-input-error :messages="$errors->get('diagnosed_date')" class="mt-2" />
					</div>
					<div class="w-full">
						<x-input-label :value="__('Treatment')" for="treatment" />
						<x-text-input :value="old('treatment')" autofocus class="mt-1 w-full" id="treatment" name="treatment" type="text" />
						<x-input-error :messages="$errors->get('treatment')" class="mt-2" />
					</div>
					<div class="w-full">
						<x-input-label :value="__('Status')" for="status" />
						<select class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
							id="status" name="status">
							<option value="active">Active</option>
							<option value="inactive">Inactive</option>
						</select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
					</div>
					<div class="w-full">
						<x-input-label :value="__('Description')" for="description" />
						<textarea rows="2" class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
						 id="description" name="description"></textarea>
                         <x-input-error :messages="$errors->get('description')" class="mt-2" />
					</div>
					<div class="flex items-center pb-2">
						<x-primary-button class=" px-6" >
							{{ __('Add') }}
						</x-primary-button>

					</div>
				</form>
			</div>

		</div>
	</div>
</div>
