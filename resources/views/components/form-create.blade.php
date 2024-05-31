@props([
    'provinces' => $provinces,
])

@if (request()->routeIs('providers.create'))
	<div class="w-full">
		<x-input-label :value="__('Title')" for="title" />
		<select autocomplete="title"
			class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="title"
			name="title">
			<option value="Dr.">Dr.</option>
		</select>
	</div>
@endif
<!-- Name -->
<div class="md:flex gap-4 space-y-2 md:space-y-0">

	<div class="w-full">
		<x-input-label :value="__('First Name')" for="first_name" />
		<x-text-input :value="old('first_name')" autocomplete="given-name" autofocus class=" mt-1 w-full" id="first_name"
			name="first_name" type="text" />
		<x-input-error :messages="$errors->get('first_name')" class="mt-2" />
	</div>
	<div class="w-full">
		<x-input-label :value="__('Middle Name')" for="middle_name" />
		<x-text-input :value="old('middle_name')" autocomplete="middle-name" autofocus class=" mt-1 w-full " id="middle_name"
			name="middle_name" type="text" />
		<x-input-error :messages="$errors->get('middle_name')" class="mt-2" />
	</div>
	<div class="w-full">
		<x-input-label :value="__('Last Name')" for="last_name" />
		<x-text-input :value="old('last_name')" autocomplete="family-name" autofocus class=" mt-1 w-full" id="last_name"
			name="last_name" type="text" />
		<x-input-error :messages="$errors->get('last_name')" class="mt-2" />
	</div>
</div>
@if (request()->routeIs('providers.create'))
	<div class="w-full">
		<x-input-label :value="__('Specialization')" for="specialization" />
		<select autocomplete="specialization"
			class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
			id="specialization" name="specialization">
			<option value="General Dentist">General Dentist</option>
		</select>
	</div>
	<input name="userType" type="hidden" value="SuperAdmin">
@endif

@if (request()->routeIs('register') || request()->routeIs('patients.create'))
	<div class="md:flex space-y-2 items-center justify-between gap-4 md:space-y-0 mt-4">
		<div class="w-full">
			<x-input-label :value="__('Birthday')" for="birthday" />
			<x-text-input :value="old('birthday')" autofocus class="mt-1 w-full" id="birthday" name="birthday" type="date" />
			<x-input-error :messages="$errors->get('birthday')" class="mt-2" />
		</div>

		<div class="w-full">
			<x-input-label :value="__('Age')" for="age" />
			<x-text-input :value="old('age')" autofocus class="mt-1 w-full" id="age" name="age" type="text" />
			<x-input-error :messages="$errors->get('age')" class="mt-2" />
		</div>
	</div>
@endif
<div class="grid md:grid-cols-2 md:gap-4">
	<div class="mt-4 ">
		<x-input-label :value="__('Province')" for="province" />
		<select autocomplete="province"
			class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="province"
			name="province">
			<option value="">Select Province</option>
			@foreach ($provinces as $province)
				<option value="{{ $province->province_code }}">{{ $province->province_name }}</option>
			@endforeach
		</select>
		<x-input-error :messages="$errors->get('province')" class="mt-2" />
	</div>
	{{-- City --}}
	<div class="mt-4">
		<x-input-label :value="__('City / Municipality')" for="city" />
		<select autocomplete="city"
			class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="city"
			name="city">

		</select>
		<x-input-error :messages="$errors->get('city')" class="mt-2" />
	</div>
	{{-- barangay --}}
	<div class="mt-4">
		<x-input-label :value="__('Barangay')" for="barangay" />
		<select autocomplete="barangay"
			class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="barangay"
			name="barangay">

		</select>
		<x-input-error :messages="$errors->get('barangay')" class="mt-2" />
	</div>
	{{-- street --}}
	<div class="mt-4">
		<x-input-label :value="__('Street (Optional)')" for="street" />
		<x-text-input :value="old('street')" autocomplete="street" class="block mt-1 w-full" id="street" name="street"
			type="text" />
		<x-input-error :messages="$errors->get('street')" class="mt-2" />
	</div>
</div>

@if (request()->routeIs('register') || request()->routeIs('patients.create'))
	<div class="grid md:grid-cols-2 md:gap-4">
		<div class="mt-4">
			<x-input-label :value="__('Phone')" for="telephone" />
			<x-text-input :value="old('telephone')" autocomplete="username" class="block mt-1 w-full" id="telephone" name="telephone"
				type="number" />
			<x-input-error :messages="$errors->get('telephone')" class="mt-2" />
		</div>

		<div class="mt-4">
			<x-input-label :value="__('Civil Status')" for="status" />
			<select autocomplete="status"
				class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
				id="status" name="status">
				<option value="">-Select Status-</option>
				<option value="Single">Single</option>
				<option value="Married">Married</option>
				<option value="Annulled">Annulled</option>
				<option value="Widowed">Widowed</option>
				<option value="Separated">Separated</option>
				<option value="Others">Others</option>
			</select>
			<x-input-error :messages="$errors->get('status')" class="mt-2" />
		</div>

	</div>
@endif
<!-- Email Address -->
<div class="mt-4">
	<x-input-label :value="__('Email')" for="email" />
	<x-text-input :value="old('email')" autocomplete="username" class="block mt-1 w-full" id="email" name="email"
		type="email" />
	<x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Password -->
<div class="mt-4">
	<x-input-label :value="__('Password')" for="password" />

	<x-text-input autocomplete="new-password" class="block mt-1 w-full" id="password" name="password"
		type="password" />

	<x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Confirm Password -->
<div class="mt-4">
	<x-input-label :value="__('Confirm Password')" for="password_confirmation" />

	<x-text-input autocomplete="new-password" class="block mt-1 w-full" id="password_confirmation"
		name="password_confirmation" type="password" />

	<x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>
