$(document).ready(function() {
    $('.btn-filter').on('click', function() {
        var $target = $(this).data('target');
        if ($target != 'all') {
            $('.table tbody tr').css('display', 'none');
            $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
        } else {
            $('.table tbody tr').css('display', 'none').fadeIn('slow');
        }
    });

    $('#checkall').on('click', function() {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function() {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function() {
                $(this).prop("checked", false);
            });
        }
    });
});


$(document).ready(function() {
    $('module table tr').css('display', 'none');
    $("#semester").change(function() {
        var $target = $('#semester').val();
        if ($target == '') {
            $('#meldung').slideDown("slow");
            $('module table tbody tr').css('display', 'none').fadeOut('slow');
        } else if ($target != 'all') {
            $('#meldung').slideUp("slow");
            $('module table tr').css('display', 'none');
            $('table tr[data-status="' + $target + '"]').fadeIn('slow');
        } else {
            $('#meldung').slideUp("slow");
            $('module table tbody tr').css('display', 'none').fadeIn('slow');
        }
    });

});