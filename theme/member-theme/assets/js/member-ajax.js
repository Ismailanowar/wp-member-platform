jQuery(document).ready(function ($) {

    $('#member-search').on('keyup', function () {
        let keyword = $(this).val();

	$('#member-role-filter').on('change', function () {
    	$('#member-search').trigger('keyup'); // trigger search to include role
	});

        $.ajax({
            url: mpAjax.ajax_url,
            type: 'POST',
            data: {
                action: 'mp_member_search',
                nonce: mpAjax.nonce,
                keyword: $('#member-search').val(),
       		 role: $('#member-role-filter').val() // NEW
            },
            success: function (response) {
                $('#member-results').html(response);
            }
        });
    });

});
