(function($) {
    $.fn.w4uMenu = function(options) {
        options = $.extend({
            icons: ['+', '-']
        }, options);

        $(this).find('ul').hide();
        $(this).find('li').each(function(){
            if ($(this).find('ul').size()>0){
                    $(this).prepend('<span data-toggle="show-menu">'+options.icons[0]+'</span>');
            }
        });

        $(document).on('click', '[data-toggle=show-menu]', function(){
            if ($(this).html()==options.icons[0]) {
                $(this).html(options.icons[1]);
                $(this).closest('li').children('ul').slideDown();
            } else {
                $(this).html(options.icons[0]);
                $(this).closest('li').children('ul').slideUp();
            }
        });

        return this;
    };
})(jQuery);