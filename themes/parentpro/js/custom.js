/**
 * Created by yulia on 09/08/14.
 */
(function ($) {
    $(function () {
        $('.link-print-inline').click(function () {
            window.print();
            return false;
        });

        $('.parentpro-calendar-month').change(function(){
            window.location = window.location.protocol + "//" + window.location.hostname + $(this).find(":selected").val();
        });


    });
})(jQuery);