@props([
    'user' => $user,
    'provinces' => $provinces,
    'cities' => $cities,
    'barangays' => $barangays,
    'modifiedAddress' => $modifiedAddress,
])

@if (request()->routeIs('providers.edit'))
	<div class="w-full">
		<x-input-label :value="__('Title')" for="title" />
		<select autocomplete="title"
			class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="title"
			name="title">
			<option value="Dr.">Dr.</option>
		</select>
	</div>
@endif
	<div class="flex items-center gap-2">
		<div>
			<x-input-label :value="__('First Name')" for="first_name" />
			<x-text-input :value="old('first_name', $user->user->first_name)" autocomplete="first_name" autofocus class="mt-1 block w-full" id="first_name"
				name="first_name" required type="text" />
			<x-input-error :messages="$errors->get('first_name')" class="mt-2" />
		</div>

		<div>
			<x-input-label :value="__('Middle Name')" for="middle_name" />
			<x-text-input :value="old('middle_name', $user->user->middle_name)" autocomplete="middle_name" autofocus class="mt-1 block w-full" id="middle_name"
				name="middle_name" type="text" />
			<x-input-error :messages="$errors->get('middle_name')" class="mt-2" />
		</div>

		<div>
			<x-input-label :value="__('Last Name')" for="last_name" />
			<x-text-input :value="old('last_name', $user->user->last_name)" autocomplete="last_name" autofocus class="mt-1 block w-full" id="last_name"
				name="last_name" required type="text" />
			<x-input-error :messages="$errors->get('last_name')" class="mt-2" />
		</div>
	</div>

    @if (request()->routeIs('providers.edit'))
	<div class="w-full">
		<x-input-label :value="__('Specialization')" for="specialization" />
		<select autocomplete="specialization"
			class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
			id="specialization" name="specialization">
			<option value="General Dentist" {{ $user->title === 'General Dentist' ? 'selected' : '' }}>General Dentist</option>
		</select>
	</div>
	<input name="userType" type="hidden" value="SuperAdmin">
@endif

@if (request()->routeIs('patients.edit'))
	<div class="md:flex space-y-2 items-center justify-between gap-2 md:space-y-0 mt-4">
		<div class="w-full">
			<x-input-label :value="__('Birthday')" for="birthday" />
			<x-text-input :value="old('birthday', $user->birthday)" autofocus class="mt-1 w-full" id="birthday" name="birthday" type="date" />
			<x-input-error :messages="$errors->get('birthday')" class="mt-2" />
		</div>

		<div class="w-full">
			<x-input-label :value="__('Age')" for="age" />
            <input type="text" class="hidden" id="hiddenAge" name="age">
			<x-text-input :value="old('age', $user->age)" autofocus class="mt-1 w-full" id="age" type="text" />
			<x-input-error :messages="$errors->get('age')" class="mt-2" />
		</div>
	</div>
@endif
	<div>
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
	<div>
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
	<div>
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

	<div>
		<x-input-label :value="__('Street (Optional)')" for="street" />
		<x-text-input :value="old('street', $modifiedAddress['street_name'])" autocomplete="street" class="block mt-1 w-full" id="street" name="street"
			type="text" />
		<x-input-error :messages="$errors->get('street')" class="mt-2" />
	</div>

    @if (request()->routeIs('patients.edit'))
	<div class="grid md:grid-cols-2 gap-2">
		<div>
			<x-input-label :value="__('Phone')" for="telephone" />
			<x-text-input :value="old('telephone', $user->telephone)" autocomplete="username" class="block mt-1 w-full" id="telephone" name="telephone"
				type="number" />
			<x-input-error :messages="$errors->get('telephone')" class="mt-2" />
		</div>
		<div>
			<x-input-label :value="__('Civil Status')" for="status" />
			<select autocomplete="status"
				class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
				id="status" name="status">
				<option value="">-Select Status-</option>
				<option value="Single" {{ $user->status === 'Single' ? 'selected' : '' }}>Single</option>
				<option value="Married" {{ $user->status === 'Married' ? 'selected' : '' }}>Married</option>
				<option value="Annulled" {{ $user->status === 'Annulled' ? 'selected' : '' }}>Annulled</option>
				<option value="Widowed" {{ $user->status === 'Widowed' ? 'selected' : '' }}>Widowed</option>
				<option value="Separated" {{ $user->status === 'Separated' ? 'selected' : '' }}>Separated</option>
				<option value="Others" {{ $user->status === 'Others' ? 'selected' : '' }}>Others</option>
			</select>
			<x-input-error :messages="$errors->get('status')" class="mt-2" />
		</div>

	</div>
@endif
	<div>
		<x-input-label :value="__('Email')" for="email" />
		<x-text-input :value="old('email', $user->user->email)" autocomplete="username" class="mt-1 block w-full" id="email" name="email"
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
