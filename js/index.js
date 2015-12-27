(function($) {
    $.fn.w4uMenu = function(options) {
        options = $.extend({
            icons: ['+', '-']
        }, options);

        $(this).find('ul').hide();
        $(this).find('li').each(function(){
            if ($(this).find('ul').size()>0){
                var temp=$(this).html();
                    $(this).html('<span>'+options.icons[0]+'</span>'+temp);
            }
        });

        $(this).find('li span').click(function(){
            if ($(this).html()==options.icons[0]) {
                $(this).html(options.icons[1]);
                $(this).parents('li').children('ul').slideDown();
            } else {
                $(this).html(options.icons[0]);
                $(this).parents('li').children('ul').slideUp();
            }
        });

        return this;
    };
})(jQuery);