<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('Book Appointment') }}
		</h2>
	</x-slot>

    {{-- breadcrumbs --}}
   <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
    <p class="text-sm font-semibold flex items-center"><a href="{{ route('user.dashboard') }}" >Services</a>
        <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg fill="currentColor" height="18px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="18px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><polygon points="160,115.4 180.7,96 352,256 180.7,416 160,396.7 310.5,256 "/></svg>
        <span class="text-primary">Slots</span>
    </p>
   </div>

	<div class="py-8">
		<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
			<div class="overflow-x-auto">
				<p class="text-text-desc text-sm">Available slots:</p>
				<div class="">
					<div class="flex gap-1 sm:gap-4 md:gap-8 lg:gap-14 mt-4">
						@foreach ($appointments as $appointment)
								<div>
									<h5 class="text-center">
										{{ $appointment['date'] }}
									</h5>
									<h5 class="text-center mb-4">
										<b> {{ $appointment['day_name'] }}</b>
									</h5>
									@if (!$appointment['off'])
										@foreach ($appointment['business_hours'] as $time)
                                                @php
                                                    $standardTime = date("g:i A", strtotime($time));
                                                @endphp
											@if (!in_array($time, $appointment['reserved_hours']))

												<form action="{{ route('reserve.appointment') }}" method="post" id="appointment-form">
													@csrf
													<input id="service_id" name="service_id" type="hidden" value=" {{ $service->id }}">
													<input id="service_name" name="service_name" type="hidden" value=" {{ $service->name }}">
													<input id="date" name="date" type="hidden" value=" {{ $appointment['full_date'] }}">
													<input id="time" name="time" type="hidden" value="{{ $time }}">

                                                    <button type="button" class="w-full modal-btn px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-background-hover focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                        {{ $standardTime }}
                                                    </button>
													<br>
													<br>
												</form>
											@else
												<button class="px-4 py-2 block bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest mb-6" disabled>{{ $standardTime }}</button>
											@endif
										@endforeach
                                    @else
                                            @foreach ($appointment['business_hours'] as $time)
											<div class="flex items-center flex-col">
                                                <button class="px-4 py-3 mb-2 text-gray-500" disabled>&#x2500;</button>
                                            </div>
										@endforeach
									@endif
							</div>
						@endforeach

					</div>
				</div>
			</div>
            <div class="mt-8 space-y-4">
            <div class="flex items-center gap-2">
                <button class="cursor-text p-4 block bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest "></button>
                <span class="font-semibold text-sm">Available </span>
            </div>

                <div class="flex items-center gap-2">
                <button class="cursor-text p-4 block bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest "></button>
                <span class="font-semibold text-sm">Not Available </span>
            </div>
            </div>
		</div>
	</div>
	</div>

    <x-appointment-confirmation/>

    <script src="{{ asset('js/appointment-card.js') }}">

    </script>
</x-app-layout>
