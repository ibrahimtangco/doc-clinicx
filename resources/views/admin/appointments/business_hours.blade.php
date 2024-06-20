<x-admin-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('Appoinments') }}
		</h2>
	</x-slot>

	<div class="container p-8">
		<div>
			<form action="{{ route('business_hours.update') }}" method="post">
				@csrf
				@foreach ($businessHours as $businessHour)
					<div class="grid grid-cols-5 place-items-center space-y-4">
						<div class="col-span-1 w-full">
							<h4 class="text-lg">
								{{ $businessHour->day }}
							</h4>
						</div>
						<input name="data[{{ $businessHour->day }}][day]" type="hidden" value="{{ $businessHour->day }}">
						<div class="col-span-1 ">
							<input class="bg-transparent text-center border-0 py-2 border-b border-gray-400"
								name="data[{{ $businessHour->day }}][from]" placeholder="From" type="text" value="{{ $businessHour->from }}">
						</div>

						<div class="col-span-1 ">
							<input class="bg-transparent text-center border-0 py-2 border-b border-gray-400"
								name="data[{{ $businessHour->day }}][to]" placeholder="To" type="text" value="{{ $businessHour->to }}">
						</div>
						<div class="col-span-1 ">
							<input class="bg-transparent text-center border-0 py-2 border-b border-gray-400"
								name="data[{{ $businessHour->day }}][step]" placeholder="Step" type="number"
								value="{{ $businessHour->step }}">
						</div>

						<div class="col-span-1 ">
							<p>
								<label>
									<input @checked($businessHour->off) class="rounded border-gray-300 border-2"
										name="data[{{ $businessHour->day }}][off]" type="checkbox" value="true" />
									<span>OFF</span>
								</label>
							</p>
						</div>
					</div>
				@endforeach

				<div class="flex justify-center">

					<x-primary-button class="px-20 mt-8" type="submit">
						save
					</x-primary-button>
				</div>
			</form>
		</div>
	</div>

</x-admin-layout>
