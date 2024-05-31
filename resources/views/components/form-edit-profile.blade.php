@props([
    'user' => $user,
    'provinces' => $provinces,
    'cities' => $cities,
    'barangays' => $barangays,
    'modifiedAddress' => $modifiedAddress,
])
	<div class="flex items-center gap-2">
		<div>
			<x-input-label :value="__('First Name')" for="first_name" />
			<x-text-input :value="old('first_name', $user->first_name)" autocomplete="first_name" autofocus class="mt-1 block w-full" id="first_name"
				name="first_name" required type="text" />
			<x-input-error :messages="$errors->get('first_name')" class="mt-2" />
		</div>

		<div>
			<x-input-label :value="__('Middle Name')" for="middle_name" />
			<x-text-input :value="old('middle_name', $user->middle_name)" autocomplete="middle_name" autofocus class="mt-1 block w-full" id="middle_name"
				name="middle_name" type="text" />
			<x-input-error :messages="$errors->get('middle_name')" class="mt-2" />
		</div>

		<div>
			<x-input-label :value="__('Last Name')" for="last_name" />
			<x-text-input :value="old('last_name', $user->last_name)" autocomplete="last_name" autofocus class="mt-1 block w-full" id="last_name"
				name="last_name" required type="text" />
			<x-input-error :messages="$errors->get('last_name')" class="mt-2" />
		</div>
	</div>
	<div class="mt-4">
		<x-input-label :value="__('Province')" for="province" />
		<select autocomplete="province"
			class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="province"
			name="province">
			<option value="">Select Province</option>
			@foreach ($provinces as $province_code => $province_name)
				<option {{ $modifiedAddress['province_code'] == $province_code ? 'selected' : '' }} value="{{ $province_code }}">
					{{ $province_name }}</option>
			@endforeach

		</select>

		<x-input-error :messages="$errors->get('province')" class="mt-2" />
	</div>
	<div class="mt-4">
		<x-input-label :value="__('City / Municipality')" for="city" />
		<select autocomplete="city"
			class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="city"
			name="city">
			@foreach ($cities as $city_code => $city_name)
				<option {{ $modifiedAddress['city_code'] == $city_code ? 'selected' : '' }} value="{{ $city_code }}">
					{{ $city_name }}</option>
			@endforeach

		</select>
		<x-input-error :messages="$errors->get('city')" class="mt-2" />
	</div>
	<div class="mt-4">
		<x-input-label :value="__('Barangay')" for="barangay" />
		<select autocomplete="barangay"
			class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="barangay"
			name="barangay">
			@foreach ($barangays as $barangay_code => $barangay_name)
				@if ($barangay_code === $modifiedAddress['brgy_code'])
					<option {{ $modifiedAddress['brgy_code'] == $barangay_code ? 'selected' : '' }}
						value="{{ $modifiedAddress['brgy_code'] }}">{{ $barangay_name }}</option>
				@else
					<option value="{{ $barangay_code }}">{{ $barangay_name }}</option>
				@endif
			@endforeach
		</select>
		<x-input-error :messages="$errors->get('barangay')" class="mt-2" />
	</div>

	<div class="mt-4">
		<x-input-label :value="__('Street (Optional)')" for="street" />
		<x-text-input :value="old('street', $modifiedAddress['street_name'])" autocomplete="street" class="block mt-1 w-full" id="street" name="street"
			type="text" />
		<x-input-error :messages="$errors->get('street')" class="mt-2" />
	</div>

	<div>
		<x-input-label :value="__('Email')" for="email" />
		<x-text-input :value="old('email', $user->email)" autocomplete="username" class="mt-1 block w-full" id="email" name="email"
			required type="email" />
		<x-input-error :messages="$errors->get('email')" class="mt-2" />

		@if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
			<div>
				<p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
					{{ __('Your email address is unverified.') }}

					<button
						class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
						form="send-verification">
						{{ __('Click here to re-send the verification email.') }}
					</button>
				</p>

				@if (session('status') === 'verification-link-sent')
					<p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
						{{ __('A new verification link has been sent to your email address.') }}
					</p>
				@endif
			</div>
		@endif
	</div>
