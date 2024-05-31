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
                $.each(response.barangay, function(index, value) {
                    $('#barangay').append('<option value="' + value.brgy_code + '">' + value.brgy_name + '</option>');
                });
            }
        });
        });
    });
});
