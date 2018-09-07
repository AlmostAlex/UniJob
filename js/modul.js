$(document).ready(function(e) {


    //group add limit
    var maxGroup = 100;

    //add more fields group        
    $(".addMore2").click(function() {
        $(".tagging").css("display", "none");
        if ($('feld2').find('.fieldGroup').length < maxGroup) {
            var fieldHTML = $('<div class="form-group fieldGroup" style="opacity:1.0;">' + $(".fieldGroupCopy").html() + '</div>').fadeIn(1000);
            $('feld2').find('.fieldGroup:last').after(fieldHTML);

            //       fieldHTML.find('.bootstrap-tagsinput').remove();

            fieldHTML.fadeIn("slow");
            fieldHTML.find('#taggin').tagsinput({
                typeahead: {
                    afterSelect: function(val) { this.$element.val(""); },
                    source: function(query) {
                        var result = null;
                        $.ajax({
                            url: "/ajax/tags.php?term=" + query,
                            type: "get",
                            dataType: "html",
                            async: false,
                            success: function(data) {
                                result = data;
                            }
                        });
                        console.log(result);

                        return JSON.parse(result);

                    }
                }
            });
        } else {
            alert('Maximum ' + maxGroup + ' groups are allowed.');
        }
    });

    //remove fields group
    $("feld2").on("click", ".remove", function() {
        $(this).parents(".fieldGroup").remove();
    });


    // Für Belegwunschverfahren
    $(".addMore3").click(function() {
        $(".tagging").css("display", "none");
        if ($('feld3').find('.fieldGroup').length < maxGroup) {
            var fieldHTML = $('<div class="form-group fieldGroup">' + $(".fieldGroupCopy2").html() + '</div>').fadeIn(1000);
            $('feld3').find('.fieldGroup:last').after(fieldHTML);
            //       fieldHTML.find('.bootstrap-tagsinput').remove();

            fieldHTML.fadeIn("slow");
            fieldHTML.find('#taggin').tagsinput({
                typeahead: {
                    afterSelect: function(val) { this.$element.val(""); },
                    source: function(query) {
                        var result = null;
                        $.ajax({
                            url: "/ajax/tags.php?term=" + query,
                            type: "get",
                            dataType: "html",
                            async: false,
                            success: function(data) {
                                result = data;
                            }
                        });
                        console.log(result);

                        return JSON.parse(result);

                    }
                }
            });
        } else {
            alert('Maximum ' + maxGroup + ' groups are allowed.');
        }
    });

    //remove fields group
    $("feld3").on("click", ".remove", function() {
        $(this).parents(".fieldGroup").remove();
    });
});

$(function() {
    $("#WindUndBew").css("display", "none");
    $("#Belegwunschverfahren").css("display", "none");
    $("#SoSe").css("display", "none");
    $("#WiSe").css("display", "none");

    $('#Semester').change(function() {

        if ($('#Semester').val() == '') {
            $('#semester_meldung').slideDown("slow");
            $('#SoSe').slideUp("slow");
            $('#WiSe').slideUp("slow");
        }
        if ($('#Semester').val() == 'SoSe') {
            $('#SoSe').slideDown("slow");
            $('#WiSe').slideUp("slow");
            $('#semester_meldung').slideUp("slow");
        } else if ($('#Semester').val() == 'WiSe') {
            $('#SoSe').slideUp("slow");
            $('#WiSe').slideDown("slow");
            $('#semester_meldung').slideUp("slow");
        }
    });

    $('#verfahren').change(function() {
        if ($('#verfahren').val() == '') {
            $('#meldung_verfahren').slideDown("slow");
            $('#Belegwunschverfahren').slideUp("slow")
            $('#WindUndBew').slideUp("slow")
        } else if ($('#verfahren').val() == 'Windhundverfahren' || $('#verfahren').val() == 'Bewerbungsverfahren') {
            $('#Belegwunschverfahren').slideUp("slow")
            $('#WindUndBew').slideDown("slow")
            $('#meldung_verfahren').slideUp("slow");
        } else if ($('#verfahren').val() == 'Belegwunschverfahren') {
            $('#WindUndBew').slideUp("slow")
            $('#Belegwunschverfahren').slideDown("slow")
            $('#meldung_verfahren').slideUp("slow");
        }
    });

    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });
});
$(document).ready(function() {
    /**
     * Typeahead
     */
    var elt = $(".tagsinput-typeahead"); //tagsinput input
    elt.tagsinput({
        typeahead: {
            afterSelect: function(val) { this.$element.val(""); },
            source: function(query) {
                var result = null;
                $.ajax({
                    url: "/ajax/tags.php?term=" + query,
                    type: "get",
                    dataType: "html",
                    async: false,
                    success: function(data) {
                        result = data;
                    }
                });
                console.log(result);

                return JSON.parse(result);

            }
        }
    });
});

function sem(str) {
    var xhttp;
    var art = document.getElementById("art"),
        artValue = art.value;
    if (str == "") {
        document.getElementById("semester_f").innerHTML = "";
        return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("semester_f").innerHTML = this.responseText;
        }
        var art = document.getElementById("art").innerHTML,
            artValue = art.value;
    };
    xhttp.open("GET", "ajax/filter_semester.php?semester=" + str + "&art=" + art, true);
    xhttp.send();
}

function art1(str) {
    var xhttp;
    if (str == "") {
        document.getElementById("art_f").innerHTML = "";
        return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("art_f").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "ajax/filter_art.php?art=" + str, true);
    xhttp.send();
}