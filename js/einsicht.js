$(document).ready(function() {
    $('#sort_einsicht_wh').DataTable({
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }],
        "order": [],
        "paging": false,
        "info": false,
        "searching": false,

    });

    $('#vgTable').DataTable({
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }],
        "order": [],
        "paging": false,
        "info": false,
        "searching": false,

    });

    $('#sort_einsicht_bel_keinTh').DataTable({
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }],
        "order": [],
        "paging": false,
        "info": false,
        "searching": false,

    });

    $('#sort_einsicht_bel').DataTable({
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }],
        "order": [],
        "paging": false,
        "info": false,
        "searching": false,

    });

});

$(function() {
    $('#verf').on('hide.bs.collapse', function() {
        $('#verfuegbar').html('Verfügbare Themen <span style="font-size: 0.7em;" class="glyphicon glyphicon-plus"></span>');
    })
    $('#verf').on('show.bs.collapse', function() {
        $('#verfuegbar').html('Verfügbare Themen <span style="font-size: 0.7em;" class="glyphicon glyphicon-minus"></span>');
    })
});

$(function() {
    $('#vergeben').on('hide.bs.collapse', function() {
        $('#verg').html('Kein Thema erhalten <span style="font-size: 0.7em;" class="glyphicon glyphicon-plus"></span>');
    })
    $('#vergeben').on('show.bs.collapse', function() {
        $('#verg').html('Kein Thema erhalten <span style="font-size: 0.7em;" class="glyphicon glyphicon-minus"></span>');
    })
});