(function ($) {
    $(document).ready(function(){
    
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
                    action: 'ylia_make_callback', //calls wp_ajax_nopriv_make_callback
                    data: form_data
                },
                success: function (data) {
                    $(this).find('input[type=text], textarea').val('');
                    $(this).find('.status').text(data.message);
                }
            });
        });

        // cart functios

        $('#hide-mini-cart').on('click', function(e){
            e.preventDefault();
            $('#cd-cart').removeClass('speed-in');
            $('#cd-shadow-layer').removeClass('is-visible');
            $('body').removeClass('overflow-hidden');
        });

        $('#cd-cart-trigger').on('click', function(e){
            e.preventDefault();
            $('#cd-cart').addClass('speed-in');
            $('#cd-shadow-layer').addClass('is-visible');
            $('body').addClass('overflow-hidden');
        });

        $('#cd-shadow-layer').on('click',function(e){
            e.preventDefault();
            $('#cd-cart').removeClass('speed-in');
            $('#cd-shadow-layer').removeClass('is-visible');
            $('body').removeClass('overflow-hidden');
        });
    });
    
}(jQuery));