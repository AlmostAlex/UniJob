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
        autoWidth: true,
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }],
        "order": [],
        "paging": false,
        "info": false,
        "searching": false,

    });


    $('#sort_nachr_bew').DataTable({
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


function swap(e) {
    var thID = $(e).data("thema");
    var bewID = $(e).data("bew-id");
    var matr = $(e).data("matr");

    $.ajax({
        url: '/ajax/ajax_controller.php?action=swap',
        dataType: 'text',
        type: 'get',
        cache: false,
        contentType: 'application/x-www-form-urlencoded',
        data: { thID: thID, bewID: bewID, matr: matr },
        success: function(data, textStatus, jQxhr) {
            $('#swapContent').html(data);
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });

}

function swap2(e) {
    var bewID_von = $(e).find(':selected').data('bew-id-von');
    var bewThID_von = $(e).find(':selected').data('bew-thema-vorher');
    var thID_zu = $(e).find(':selected').data('thema');
    var bewID_zu = $(e).find(':selected').data('bew-id');
    $(e).prop('disabled', 'disabled');


    $.ajax({
            url: '/ajax/ajax_controller.php?action=swapAgain',
            dataType: 'text',
            type: 'get',
            cache: false,
            contentType: 'application/x-www-form-urlencoded',
            data: { bewID_von: bewID_von, bewThID_von: bewThID_von, thID_zu: thID_zu, bewID_zu: bewID_zu },
            success: function(data, textStatus, jQxhr) {
                $("#sw1").append('<div style="position: absolute;margin-top: -36px; margin-left: 675px;padding: 6px;" class="alert alert-info"><i class="fas fa-info-circle"></i> Updated</div> <br> <div class="inner' + ($('#test div').length + 1) + '">' + data + '</div>').fadeIn(1000);
                console.log(data);
            },
            error: function(jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        }

    )
}

$(document).ready(function() {
    $('textarea#summernote').summernote({
        toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['fontsize', ['fontsize']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']]
        ],
        popover: {
            image: [],
            link: [],
            air: []
        }
      });
  });

$(document).ready(function() {
    $("input:checkbox:not(:checked)").each(function() {
        var column = "table ." + $(this).attr("name");
        $(column).hide();
    });

    $("input:checkbox").click(function() {
        var column = "table ." + $(this).attr("name");
        $(column).toggle();
    });
});

$(document).ready(function(e) {
    $("select.positionTypes").change(function() {
        $("select.positionTypes option[value='" + $(this).data('index') + "']").prop('disabled', false);
        $(this).data('index', this.value);
        $("select.positionTypes option[value='" + this.value + "']:not([value=''])").prop('disabled', true);
    });

    $('form').submit(function(e) {
        $(':disabled').each(function(e) {
            $(this).removeAttr('disabled');
        })
    });
});



/* 
$(document).ready(function() {

    $("#downloadlink").click(function() {
        //var liste = $("input[name='Liste']:checked").val();
        var liste = document.getElementById("Liste").value;
        var id = $("#Liste").data('modul-id');
        alert(id);
        $.get('../../ajax/ajax_controller.php', 'action=exportBEL&id=' + id + '&list=all', function() {
            document.location.href = '../../ajax/ajax_controller.php?action=exportBEL&id=' + id + '&list=all';

        });
    });
});
*/

/* EXPORT */


$(document).ready(function() {

    //BELEGWUNSCHV START
    //all
    $("#ListeAll").click(function() {
        //var liste = $("input[name='Liste']:checked").val();
        //var liste = document.getElementById("ListeAll").value;
        var id = $("#ListeAll").data('modul-id');
        var verf = $("#ListeAll").data('verfahren');
        $.get('../../ajax/ajax_controller.php', 'action=' + verf + '&art=all&id=' + id, function() {
            document.location.href = '../../ajax/ajax_controller.php?action=' + verf + '&art=all&id=' + id;

        });
    });

    $("#ListeVerfTh").click(function() {
        //var liste = $("input[name='Liste']:checked").val();
        var id = $("#ListeVerfTh").data('modul-id');
        var verf = $("#ListeVerfTh").data('verfahren');
        $.get('../../ajax/ajax_controller.php', 'action=' + verf + '&art=verfTh&id=' + id, function() {
            document.location.href = '../../ajax/ajax_controller.php?action=' + verf + '&art=verfTh&id=' + id;

        });
    });

    $("#ListeVergTh").click(function() {
        //var liste = $("input[name='Liste']:checked").val();
        var id = $("#ListeVergTh").data('modul-id');
        var verf = $("#ListeVergTh").data('verfahren');
        $.get('../../ajax/ajax_controller.php', 'action=' + verf + '&art=vergTh&id=' + id, function() {
            document.location.href = '../../ajax/ajax_controller.php?action=' + verf + '&art=vergTh&id=' + id;

        });
    });

    $("#ListeNachr").click(function() {
        //var liste = $("input[name='Liste']:checked").val();
        var id = $("#ListeNachr").data('modul-id');
        var verf = $("#ListeNachr").data('verfahren');
        $.get('../../ajax/ajax_controller.php', 'action=' + verf + '&art=nachr&id=' + id, function() {
            document.location.href = '../../ajax/ajax_controller.php?action=' + verf + '&art=nachr&id=' + id;

        });
    });

    //BELEGWUNSCHV ENDE

    // BEWERBUNGSV START 
    $("#ListeAlleBew").click(function() {
        //var liste = $("input[name='Liste']:checked").val();
        //var liste = document.getElementById("ListeAll").value;
        var id = $("#ListeAlleBew").data('modul-id');
        var verf = $("#ListeAlleBew").data('verfahren');
        $.get('../../../ajax/ajax_controller.php', 'action=' + verf + '&art=all&id=' + id, function() {
            document.location.href = '../../../ajax/ajax_controller.php?action=' + verf + '&art=allBEW&id=' + id;
        });
    });



});

// Expan all Button aus der Gesamt-Einsicht für Bewerbungen

$(function() {

    var active = true;

    $('#collapse-init').click(function() {
        if (active) {
            active = false;
            $('.panel-collapse').collapse('show');
            $('.panel-title').attr('data-toggle', '');
            $(this).text('Schließe alle Themen');
        } else {
            active = true;
            $('.panel-collapse').collapse('hide');
            $('.panel-title').attr('data-toggle', 'collapse');
            $(this).text('Öffne alle Themen');
        }
    });

    $('#accordion').on('show.bs.collapse', function() {
        if (active) $('#accordion .in').collapse('hide');
    });

});