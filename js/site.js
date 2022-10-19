(function ($) {
    if($('#slider ul').length > 0){
        $('#slider ul').lightSlider({
            adaptiveHeight: true,
            item: 1,
            slideMargin: 0,
            loop: true
        });
    };
    // sending callback form
    $(document).on('submit', '.callback-form', function (e) {
        var form_data = $(this).serializeArray();
        e.preventDefault();
//        $('form#login p.status').show().text(ajax_login_object.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: khmarska_calllback_object.ajaxurl,
            data: {
                action: 'khmarska_make_callback', //calls wp_ajax_nopriv_make_callback
                data: form_data
            },
            success: function (data) {
                $(this).find('input[type=text], textarea').val('');
                $(this).find('.status').text(data.message);
            }
        });
    });
    
}(jQuery));