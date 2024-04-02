(function ($) {
    $('#reset').click(function() {
        $.get(ajax_object.ajax_url, {
            action: 'reset_users',
            _ajax_nonce: ajax_object.nonce,
        }, function(response) {
            if (response.success) {
                window.location.href = response.data;
            }else {
                alert(response.data);
            }  
        });
    });

})(jQuery);