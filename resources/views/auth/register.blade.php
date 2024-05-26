
<x-guest-layout>
    <div class="w-full mt-6 px-6 py-4 lg:max-w-3xl bg-white sm:shadow-md overflow-hidden sm:rounded-lg">
        <div class="mb-8">
            <h1 class="text-title text-2xl font-semibold">Create Account</h1>
        </div>
    <form method="POST" action="{{ route('register') }}" class="w-full">
        @csrf

        <!-- Name -->
        <div class="md:flex gap-4 space-y-2 md:space-y-0">
            <div class="w-full">
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input id="first_name" class=" mt-1 w-full" type="text" name="first_name" :value="old('first_name')" autofocus autocomplete="given-name" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>
            <div class="w-full">
                <x-input-label for="middle_name" :value="__('Middle Name')" />
                <x-text-input id="middle_name" class=" mt-1 w-full " type="text" name="middle_name" :value="old('middle_name')" autofocus autocomplete="middle-name" />
                <x-input-error :messages="$errors->get('middle_name')" class="mt-2" />
            </div>
            <div class="w-full">
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input id="last_name" class=" mt-1 w-full" type="text" name="last_name" :value="old('last_name')" autofocus autocomplete="family-name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>
        </div>
        <div class="md:flex space-y-2 items-center justify-between gap-4 md:space-y-0 mt-4">
            <div class="w-full">
                <x-input-label for="birthday" :value="__('Birthday')" />
                <x-text-input id="birthday" class="mt-1 w-full" type="date" name="birthday" :value="old('birthday')" autofocus autocomplete="family-name" />
                <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
            </div>

            <div class="w-full">
                <x-input-label for="age" :value="__('Age')" />
                <x-text-input id="age" class="mt-1 w-full" type="text" name="age" :value="old('age')" autofocus autocomplete="family-name" />
                <x-input-error :messages="$errors->get('age')" class="mt-2" />
            </div>
        </div>
        <div class="grid md:grid-cols-2 md:gap-4">
            <div class="mt-4 ">
            <x-input-label for="province" :value="__('Province')" />
            <select name="province" id="province" class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" autocomplete="province">
                <option value="">Select Province</option>
                @foreach ($provinces as $province)
                    <option value="{{ $province->province_code }}">{{ $province->province_name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('province')" class="mt-2" />
        </div>
        {{-- City --}}
        <div class="mt-4">
            <x-input-label for="city" :value="__('City / Municipality')" />
            <select name="city" id="city" class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" autocomplete="city">

            </select>
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>
        {{-- barangay --}}
        <div class="mt-4">
            <x-input-label for="barangay" :value="__('Barangay')" />
            <select name="barangay" id="barangay" class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" autocomplete="barangay">

            </select>
            <x-input-error :messages="$errors->get('barangay')" class="mt-2" />
        </div>
        {{-- street --}}
        <div class="mt-4">
            <x-input-label for="street" :value="__('Street (Optional)')" />
            <x-text-input id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street')" autocomplete="street" />
            <x-input-error :messages="$errors->get('street')" class="mt-2" />
        </div>
        </div>

        <div class="grid md:grid-cols-2 md:gap-4">
            <div class="mt-4">
                <x-input-label for="telephone" :value="__('Phone')" />
                <x-text-input id="telephone" class="block mt-1 w-full" type="number" name="telephone" :value="old('telephone')" autocomplete="username" />
                <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
            </div>

            <div class="mt-4">
            <x-input-label for="status" :value="__('Civil Status')" />
            <select name="status" id="status" class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" autocomplete="status">
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
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-text-desc hover:text-text-title" href="{{ route('login') }}">
                {{ __('Login account') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    </div>

    <script>
        // birthday age
        const birthday = document.querySelector('#birthday');
        const ageField = document.querySelector('#age');

        birthday.addEventListener('change', () => {
            const selectedDate = new Date(birthday.value);
            const today = new Date();
            let age = today.getFullYear() - selectedDate.getFullYear();

            // Adjust age if birthday for this year hasn't occurred yet
            if (today.getMonth() < selectedDate.getMonth() || (today.getMonth() === selectedDate.getMonth() && today.getDate() < selectedDate.getDate())) {
                age--;
            }

            // Set the value of the age field as the calculated age
            ageField.value = age.toString();
        });





    $(document).ready(function() {
    $('#province').change(function() { // Listen for change event on province dropdown
        var province_code = $(this).val(); // Get the selected value of province dropdown
        $('#city').html(''); // Clear the city dropdown

         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


        $.ajax({
            url: 'api/fetch-city',
            type: 'POST',
            dataType: 'json',
            data: {
                'province_code': province_code
            },
            success: function(response) {
                $('#city-dd').html('<option value="">-Select City / Municipality-</option>');
                $.each(response.cities, function(index, value) {
                    $('#city').append('<option value="' + value.city_code + '">' + value.city_name + '</option>');
                });
            }
        });

        $('#city').change(function() {
            var city_code = $(this).val();
            $('#barangay').html('');

            $.ajax({
            url: 'api/fetch-barangay',
            type: 'POST',
            dataType: 'json',
            data: {
                'city_code': city_code
            },

            success: function(response) {
                $('#barangay').html('<option value="">-Select Barangay-</option>');
                $.each(response.barangay, function(index, value) {
                    $('#barangay').append('<option value="' + value.brgy_code + '">' + value.brgy_name + '</option>');
                });
            }
        });
        });
    });
});

    </script>
</x-guest-layout>
