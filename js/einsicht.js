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


function swap(e) {
    var thID = $(e).data("thema");
    var bewID = $(e).data("bew-id");
    var matr = $(e).data("matr");
    var count = 0;
    $.ajax({
        url: '/ajax/ajax_controller.php?action=swap',
        dataType: 'text',
        type: 'get',
        contentType: 'application/x-www-form-urlencoded',
        data: { thID: thID, bewID: bewID, matr: matr },
        success: function(data, textStatus, jQxhr) {
            $('#swapContent').html(data);
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
    e.preventDefault();
}

function swapAgain(e) {
    //  alert("ee");

    var name = "hi";
    var id = $(e).val();
    var fieldHTML = $('<div id="test">' + +'</div>').fadeIn(1000);

    $.ajax({
            url: '/ajax/ajax_controller.php?action=swapAgain',
            dataType: 'text',
            type: 'get',
            contentType: 'application/x-www-form-urlencoded',
            data: { id: id },
            success: function(data, textStatus, jQxhr) {
                //$("#test").html(data);
                // $("#test").append('<div class="inner' + count + '">' + data + '</div>');
                $("#test").append('<div class="inner' + ($('#test div').length + 1) + '">' + data + '</div>').html();
                ///$('#inner' + count).html(data);

                // console.log($('<div class="inner' + ($('#test div').length + 1) + '">' + data + '</div>'));
                //console.log(data);
            },
            error: function(jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            }

        }

    );
}
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

/*

   if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
       xmlhttp = new XMLHttpRequest();
   } else { // code for IE6, IE5
       xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
   }

   xmlhttp.onreadystatechange = function() {
       if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
           document.getElementById("swapContent").innerHTML = xmlhttp.responseText;
           $('[data-toggle="tooltip"]').tooltip();
       }
   }
   xmlhttp.open("GET", "/ajax/ajax_controller.php?action=swap&thID=" + thID + "&bewID=" + bewID + "&matr=" + matr, true);
   xmlhttp.send(); 
}*/