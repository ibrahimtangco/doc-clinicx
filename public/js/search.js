
// search
        $('#searchDentist').on('keyup', function() {

		$searchValue = $(this).val();

        if($searchValue !== ''){
            $('#searchData').show();
            $('#allData').hide();
        }
        else {
            $('#searchData').hide();
            $('#allData').show();
        }

        $.ajax({
            type:'get',
            url:"{{ 'admin/provider/search' }}",
            data: {'search':$searchValue},

            success:function(data) {
                    $('#searchData').html(data);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
	});
