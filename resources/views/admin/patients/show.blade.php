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
						{{ $patient->user->first_name }}
						@if ($patient->user->middle_name)
							{{ ucfirst(substr($patient->user->middle_name, 0, 1)) }}.
						@endif
						{{ $patient->user->last_name }}
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
			</div>
		</div>
		<div class="my-8 p-8 bg-white rounded-md border">
			<div class="flex items-center mb-6 justify-between">
                <h1 class="font-semibold text-lg">Medical History</h1>
                <div class="text-primary">
                    <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg height="32px" fill="currentColor" id="Layer_1" style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32" width="32px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M28,14H18V4c0-1.104-0.896-2-2-2s-2,0.896-2,2v10H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h10v10c0,1.104,0.896,2,2,2  s2-0.896,2-2V18h10c1.104,0,2-0.896,2-2S29.104,14,28,14z"/></svg>
                </div>
            </div>
			<div class="md:grid grid-cols-4 gap-8 space-y-4 md:space-y-0 border py-3">
				<div class="flex flex-col gap-2 mt-1">
					<label>Condition</label>
					<div class="p-2 border rounded-md bg-gray-100/80">
						Diabetes
					</div>
				</div>
				<div class="flex flex-col gap-2 mt-1">
					<label>Diagnosed Date</label>
					<div class="p-2 border rounded-md bg-gray-100/80">
						May 11, 2024
					</div>
				</div>
				<div class="flex flex-col gap-2 mt-1">
					<label>Treatment</label>
					<div class="p-2 border rounded-md bg-gray-100/80">
						Prayers
					</div>
				</div>
				<div class="flex flex-col gap-2 mt-1 col-span-1">
					<label>Status</label>
					<div class="p-2 border rounded-md bg-gray-100/80">
						Active
					</div>
				</div>
                <div class="flex flex-col gap-2 mt-1 col-span-4">
					<label>Description</label>
					<div class="p-2 border rounded-md bg-gray-100/80">
						The patient condition is Stage 3 diabetes.
					</div>
				</div>
			</div>
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
</x-admin>
