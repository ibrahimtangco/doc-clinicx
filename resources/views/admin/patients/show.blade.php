<x-admin>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('Patients Record') }}
		</h2>
	</x-slot>

	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

		<div class="my-8 p-8 bg-white rounded-md border">
			<h1 class="font-semibold text-lg mb-4">Personal Information</h1>
			<div class="md:grid grid-cols-3 gap-8 space-y-4 md:space-y-0">
				<div class="flex flex-col gap-2 mt-1">
					<label>Full Name</label>
					<div class="p-2 border rounded-md bg-gray-100/80">
						{{ $patient->user->full_name }}
					</div>
				</div>
				<div class="flex flex-col gap-2 mt-1">
					<label for="name">Birthday</label>
					<div class="p-2 border rounded-md bg-gray-100/80">
						{{ \Carbon\Carbon::parse($patient->birthday)->format('F j, Y') }}
					</div>
				</div>
				<div class="flex flex-col gap-2 mt-1">
					<label for="name">Age</label>
					<div class="p-2 border rounded-md bg-gray-100/80">
						{{ $patient->age }}
					</div>
				</div>
				<div class="flex flex-col gap-2 mt-1">
					<label for="name">Civil Status</label>
					<div class="p-2 border rounded-md bg-gray-100/80">
						{{ $patient->status }}
					</div>
				</div>
				<div class="flex flex-col gap-2 mt-1">
					<label for="name">Email Address</label>
					<div class="p-2 border rounded-md bg-gray-100/80">
						{{ $patient->user->email }}
					</div>
				</div>
				<div class="flex flex-col gap-2 mt-1">
					<label for="name">Phone Number</label>
					<div class="p-2 border rounded-md bg-gray-100/80">
						{{ $patient->telephone }}
					</div>
				</div>

                <div class="flex flex-col gap-2 mt-1">
					<label for="name">Address</label>
					<div class="p-2 border rounded-md bg-gray-100/80">
						{{ $patient->user->address }}
					</div>
				</div>
			</div>
		</div>
		<div class="my-8 p-8 bg-white rounded-md" >
            @if (session('message'))
                <x-alert type='success'>{{ session('message') }}</x-alert>
            @elseif (session('error'))
                <x-alert type='error'>{{ session('error') }}</x-alert>

            @endif

			<div class="flex items-center mb-6 justify-between">
				<h1 class="font-semibold text-lg">Medical History</h1>
				<a class="text-primary cursor-pointer" id="add-medical-history-btn">
					<?xml version="1.0" ?>
					<!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 1.1//EN' 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg
						fill="currentColor" height="30px" id="Layer_1" style="enable-background:new 0 0 32 32;" version="1.1"
						viewBox="0 0 32 32" width="30px" xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M28,14H18V4c0-1.104-0.896-2-2-2s-2,0.896-2,2v10H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h10v10c0,1.104,0.896,2,2,2  s2-0.896,2-2V18h10c1.104,0,2-0.896,2-2S29.104,14,28,14z" />
					</svg>
				</a>
                    <x-add_medical_history_modal :patientId="$patient->id"/>

			</div>
			@if (!$medicalHistories->isEmpty())
				<table class="border w-full text-sm text-left rtl:text-right text-gray-500">
					<thead class="text-xs text-gray-700 uppercase bg-gray-50">
						<tr>
							<th class="px-6 py-3" scope="col">Condition</th>
							<th class="px-6 py-3" scope="col">Diagnosed Date</th>
							<th class="px-6 py-3" scope="col">Status</th>
							<th class="px-6 py-3" scope="col">Action</th>
						</tr>

					</thead>
					<tbody>
						@foreach ($medicalHistories as $medicalHistory)
							<tr class="border-y odd:bg-white even:bg-gray-100">
								<td class="px-6 py-3" scope="col">{{ $medicalHistory->condition }}</td>
								<td class="px-6 py-3" scope="col">{{ $medicalHistory->diagnosed_date_formatted }}</td>
								<td class="px-6 py-3 font-semibold" scope="col">
                                    @if ($medicalHistory->status == 'active')
                                        <span class="text-green-500">{{ Str::ucfirst($medicalHistory->status) }}</span>
                                    @else
                                    <span class="text-red-500">{{ Str::ucfirst($medicalHistory->status) }}</span>
                                    @endif</td>
								<td class="px-6 py-3" scope="col"><button
                                    data-condition="{{ $medicalHistory->condition }}"
                                    data-diagnosed-date="{{ $medicalHistory->diagnosed_date }}"
                                    data-status="{{ $medicalHistory->status }}"
                                    data-treatment="{{ $medicalHistory->treatment }}"
                                    data-description="{{ $medicalHistory->description }}"
                                    data-id="{{ $medicalHistory->id }}"
                                    onclick="openMedicalHistoryModal(this)"
										class="edit-medical-history-btn font-medium text-white bg-blue-600 px-2 py-1 rounded hover:bg-blue-700">View</button></td>
							</tr>
                            <x-edit_medical_history_modal :patientId="$patient->id"/>
						@endforeach
					</tbody>
				</table>
                <div class="p-4">
                    {{ $medicalHistories->links('pagination::tailwind') }}
                </div>
			@else
				<p>No record</p>
			@endif
		</div>
		<div class="my-8 p-8 bg-white rounded-md border">
			<h1 class="font-semibold text-lg">Delete All Patient Records</h1>
			<p class="text-sm text-text-desc">Once your account is deleted, all of its resources and data will be permanently
				deleted.</p>

			<section class="space-y-6 mt-4">
				<x-danger-button x-data=""
					x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete Account') }}</x-danger-button>

				<x-modal :show="$errors->userDeletion->isNotEmpty()" focusable name="confirm-user-deletion">
					<form action="{{ route('patients.destroy', ['patient' => $patient->id]) }}" class="p-6" method="post">
						@csrf
						@method('delete')

						<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
							{{ __('Are you sure you want to delete your account?') }}
						</h2>

						<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
							{{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
						</p>

						<div class="mt-6 flex justify-end">
							<x-secondary-button x-on:click="$dispatch('close')">
								{{ __('Cancel') }}
							</x-secondary-button>

							<x-danger-button class="ms-3">
								{{ __('Delete Account') }}
							</x-danger-button>
						</div>
					</form>
				</x-modal>
			</section>

		</div>
	</div>

    <script>
    // Get references to the button, modal, and close button
    const addBtn = document.querySelector('#add-medical-history-btn');
    const editBtns = document.querySelectorAll('.edit-medical-history-btn')
    const addModal = document.querySelector('#add-medical-history-modal');
    const editModal = document.querySelector('.edit-medical-history-modal');
    const closeAddBtn = document.querySelector('#add-medical-history-close-btn');
    const closeEditBtn = document.querySelector('.edit-medical-history-close-btn');

    function formatDateTime(dateTimeString) {
        // Split the string by space and take the first part
        return dateTimeString.split(' ')[0];
    }

    function openMedicalHistoryModal(button) {

        // Get data from the button's data attributes
        const condition = button.getAttribute('data-condition');
        const diagnosedDate = button.getAttribute('data-diagnosed-date');
        const status = button.getAttribute('data-status');
        const treatment = button.getAttribute('data-treatment');
        const description = button.getAttribute('data-description');
        const id = button.getAttribute('data-id');
        console.log(treatment)

        document.querySelector('#edit-condition').value = condition;
        document.querySelector('#edit-diagnosed_date').value = formatDateTime(diagnosedDate);
        document.querySelector('#edit-status').value = status;
        document.querySelector('#edit-treatment').value = treatment;
        document.querySelector('#edit-description').value = description;
        document.querySelector('#edit-id').value = id;

    }


    // Function to toggle modal visibility
    function toggleAddModal() {
        addModal.classList.toggle('hidden');
        addModal.classList.toggle('flex');
    }

    function toggleEditModal() {
        editModal.classList.toggle('hidden')
        editModal.classList.toggle('flex')
    }

    // Event listeners for button and close button
    addBtn.addEventListener('click', toggleAddModal);
    closeAddBtn.addEventListener('click', toggleAddModal);

    editBtns.forEach(editBtn => {
        editBtn.addEventListener('click', toggleEditModal);
    });

    closeEditBtn.addEventListener('click', toggleEditModal);
</script>


</x-admin>
