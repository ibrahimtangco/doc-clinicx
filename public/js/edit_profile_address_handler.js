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
                url: '/get-cities/' + provinceCode,
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
                url: '/get-barangays/' + cityCode,
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
