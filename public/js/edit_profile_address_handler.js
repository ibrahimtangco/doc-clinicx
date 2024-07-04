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
             $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                url: '/get-cities/' + provinceCode,
                type: 'POST',
                success: function(response) {

                    $('#city').empty().append('<option value="">-Select City-</option>');
                    $('#barangay').html('');

                    $.each(response.cities, function(key, city) {
                        $('#city').append('<option value="' + city.city_code + '">' + city.city_name + '</option>');
                    });

                    if (selectedCityCode) {
                        $('#city').val(selectedCityCode).change();
                    }
                },
                error: function (xhr, status, error) {
                console.error("Error occurred: " + error);
            },
            });
        } else {
            $('#barangay').empty().append('<option value="">-Select City-</option>');
        }
    }

    // Function to load barangays
    function loadBarangays(cityCode, selectedBarangayCode) {
        if (cityCode) {
            $.ajaxSetup({
                headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
            $.ajax({
                url: '/get-barangays/' + cityCode,
                type: 'POST',
                success: function(response) {
                    $('#barangay').empty().append('<option value="">Select Barangay</option>');
                    $.each(response.barangays, function(key, barangay) {
                        $('#barangay').append('<option value="'+ barangay.brgy_code +'">'+ barangay.brgy_name +'</option>');
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
