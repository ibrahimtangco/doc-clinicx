<section>
	<header>
		<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
			{{ __('Profile Information') }}
		</h2>

		<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
			{{ __("Update your account's profile information and email address.") }}
		</p>

	</header>

	<form action="{{ route('verification.send') }}" id="send-verification" method="post">
		@csrf
	</form>
	<form action="{{ route('profile.update') }}" class="mt-6 space-y-6" method="post">
		@csrf
		@method('patch')

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
				class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
				id="province" name="province">
				<option value="">Select Province</option>
                @foreach ($provinces as $province_code => $province_name)
                    <option value="{{ $province_code }}" {{ $modifiedAddress[2][0] == $province_code ? 'selected' : '' }}>{{ $province_name }}</option>
                @endforeach

			</select>

			<x-input-error :messages="$errors->get('province')" class="mt-2" />
		</div>
		<div class="mt-4">
			<x-input-label :value="__('City / Municipality')" for="city" />
			<select autocomplete="city"
				class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
				id="city" name="city">
                 @foreach ($cities as $city_code => $city_name)
                    <option value="{{ $city_code }}" {{ $modifiedAddress[1][0] == $city_code ? 'selected' : '' }}>{{ $city_name }}</option>
                 @endforeach

			</select>
			<x-input-error :messages="$errors->get('city')" class="mt-2" />
		</div>
		<div class="mt-4">
			<x-input-label :value="__('Barangay')" for="barangay" />
			<select autocomplete="barangay"
				class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
				id="barangay" name="barangay">
                 @foreach ($barangays as $barangay_code => $barangay_name)
                    @if ($barangay_code === $modifiedAddress[0][0])
                        <option value="{{ $modifiedAddress[0][0] }}" {{ $modifiedAddress[0][0] == $barangay_code ? 'selected' : '' }}>{{ $barangay_name }}</option>
                    @else
                        <option value="{{ $barangay_code }}">{{ $barangay_name }}</option>

                    @endif
                 @endforeach
			</select>
			<x-input-error :messages="$errors->get('barangay')" class="mt-2" />
		</div>

		<div class="mt-4">
			<x-input-label :value="__('Street (Optional)')" for="street" />
			<x-text-input :value="old('street', $user->street)" autocomplete="street" class="block mt-1 w-full" id="street" name="street"
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

		<div class="flex items-center gap-4">
			<x-primary-button>{{ __('Save') }}</x-primary-button>

			@if (session('status') === 'profile-updated')
				<p class="text-sm text-gray-600 dark:text-gray-400" x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
					x-transition>{{ __('Saved.') }}</p>
			@endif
		</div>
	</form>
</section>
<script>
    $(document).ready(function() {
    // Set up CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Function to load cities
    function loadCities(provinceCode, selectedCityCode) {
        if (provinceCode) {
            $.ajax({
                url: '{{ url("/get-cities") }}/' + provinceCode,
                type: 'GET',
                success: function(cities) {
                    $('#city').empty().append('<option value="">Select City</option>');
                    $.each(cities, function(code, name) {
                        $('#city').append('<option value="'+ code +'">'+ name +'</option>');
                    });
                    if (selectedCityCode) {
                        $('#city').val(selectedCityCode).change();
                    }
                }
            });
        } else {
            $('#city').empty().append('<option value="">Select City</option>');
            $('#barangay').empty().append('<option value="">Select Barangay</option>');
        }
    }

    // Function to load barangays
    function loadBarangays(cityCode, selectedBarangayCode) {
        if (cityCode) {

            $.ajax({
                url: '{{ url("/get-barangays") }}/' + cityCode,
                type: 'GET',
                success: function(barangays) {

                    $('#barangay').empty().append('<option value="">Select Barangay</option>');
                    $.each(barangays, function(code, name) {
                        $('#barangay').append('<option value="'+ code +'">'+ name +'</option>');
                    });
                    if (selectedBarangayCode) {
                        console.log(selectedBarangayCode)
                        $('#barangay').val(selectedBarangayCode);
                    }
                }
            });
        } else {
            $('#barangay').empty().append('<option value="">Select Barangay</option>');
        }
    }

    // Event handler for province change
    $('#province').change(function() {
        var provinceCode = $(this).val();
        loadCities(provinceCode, null);
        loadBarangays(null, null);
    });

    // Event handler for city change
    $('#city').change(function() {
        var cityCode = $(this).val();
        loadBarangays(cityCode, null);
    });


});

    </script>
