<x-admin>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			<a href="{{ route('patients.index') }}">{{ __('Patients') }}</a>
		</h2>
	</x-slot>
	{{-- main container --}}
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<div class="max-w-xl">
					<section>
						<header>
							@if (session('message'))
								<x-alert>
									{{ session('message') }}
								</x-alert>
							@endif
							<h2 class="text-lg font-medium text-gray-900">
								{{ __('Add Patient') }}
							</h2>

							<p class="mt-1 text-sm text-gray-600">
								{{ __('Add new patient\'s information.') }}
							</p>
						</header>
						<form action="{{ route('patients.store') }}" class="mt-6 space-y-6" method="post">
							@csrf

							<x-form-create :provinces="$provinces"/>

								<div class="flex items-center gap-4">
									<x-primary-button>{{ __('Create') }}</x-primary-button>

								</div>
						</form>
					</section>

				</div>
			</div>
		</div>
	</div>

    <script src="{{ asset('js/autofill_age.js') }}"></script>
	<script src="{{ asset('js/register_address_handler.js') }}"></script>
</x-admin>
