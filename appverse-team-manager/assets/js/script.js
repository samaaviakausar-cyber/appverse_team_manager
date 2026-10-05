jQuery(function($) {

    $(document).on('click', '.atm-filter', function() {

        var button = $(this);
        var department = button.data('department');

        $('.atm-filter').removeClass('active');
        button.addClass('active');

        $('#atm-team-results').addClass('atm-loading');

        $.ajax({
            url: atm_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'atm_filter_team',
                nonce: atm_ajax.nonce,
                department: department
            },

            success: function(response) {
                $('#atm-team-results').html(response);
            },

            error: function() {
                $('#atm-team-results').html(
                    '<p class="atm-no-results">Something went wrong. Please try again.</p>'
                );
            },

            complete: function() {
                $('#atm-team-results').removeClass('atm-loading');
            }
        });

    });

});