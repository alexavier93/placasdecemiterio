(function ($) {
    "use strict";


    $(document).on('click', '.delete', function () {
        var id = $(this).attr('data-id');
        $('#id').val(id);
    });


    // Jquery Mask
    $('.money').mask("#.##0,00", {reverse: true});

    $('.cm').mask('##0,00', {reverse: true});

})(jQuery, window, document);