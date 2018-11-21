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


$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function(e) {
    var maxGroup = 100;

    //add more fields group        
    $(".addMore2").click(function() {
        $(".taggin").css("display", "none");

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
            fieldHTML.find('#vork').tagsinput({
                typeahead: {
                    afterSelect: function(val) { this.$element.val(""); },
                    source: function(query) {
                        var result = null;
                        $.ajax({
                            url: "/ajax/vorkenntnisse.php?term=" + query,
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
        $(".taggin").css("display", "none");
        $(".vork").css("display", "none");

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

            fieldHTML.find('#vork').tagsinput({
                typeahead: {
                    afterSelect: function(val) { this.$element.val(""); },
                    source: function(query) {
                        var result = null;
                        $.ajax({
                            url: "/ajax/vorkenntnisse.php?term=" + query,
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


    $("#Seminarmodul").css("display", "none");
    $("#Professur").css("display", "none");
    $('input[type="radio"]').click(function() {
        if ($(this).attr("value") == "Seminararbeit") {
            $('#Seminarmodul').slideDown("slow");
            $('#kategorie_meldung').slideUp("slow");
            $('#Professur').slideUp("slow");
        }
        if ($(this).attr("value") == "Abschlussarbeit") {
            $('#Professur').slideDown("slow");
            $('#kategorie_meldung').slideUp("slow");
            $('#Seminarmodul').slideUp("slow");

        }
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

    $('#SemesterEdit').ready(function() {
        if ($('#SemesterEdit').val() == 'SoSe') {
            $('#SoSe').show();
            $('#WiSe').slideUp("slow");
        } else if ($('#SemesterEdit').val() == 'WiSe') {
            $('#SoSe').slideUp("slow");
            $('#WiSe').show();
        }
    });
    $('#SemesterEdit').change(function() {
        if ($('#SemesterEdit').val() == 'SoSe') {
            $('#SoSe').slideDown("slow");
            $('#WiSe').slideUp("slow");
        } else if ($('#SemesterEdit').val() == 'WiSe') {
            $('#SoSe').slideUp("slow");
            $('#WiSe').slideDown("slow");
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

$(document).ready(function() {
    /**
     * Typeahead
     */
    var elt = $(".tagsinput-typeahead2"); //tagsinput input
    elt.tagsinput({

        typeahead: {
            afterSelect: function(val) { this.$element.val(""); },
            source: function(query) {
                var result = null;
                $.ajax({
                    url: "/ajax/vorkenntnisse.php?term=" + query,
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

function filter() {

    var tagsarray = new Array();
    $('#tags option:selected').each(
        function(i) {
            tagsarray[i] = $(this).text();
        });


    var semester = document.getElementById("semester").value;
    var art = document.getElementById("art").value;
    var betreuer = document.getElementById("betreuer").value;

    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("semester_f").innerHTML = xmlhttp.responseText;
        }
    }
    var tags = "'" + tagsarray.join("','") + "'";
    var url = "ajax/ajax_controller.php?action=filter&semester=" + semester + "&art=" + art + "&betreuer=" + betreuer;
    url = url + "&tags=" + tags;

    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function r_art() {
    //$("#art").find("option[value='']").attr('selected', true);
    $("#art option[value='']").prop("selected", true);
    filter();
}

function r_betreuer() {
    //$("#betreuer").find("option[value='']").attr('selected', true);
    $("#betreuer option[value='']").prop("selected", true);
    filter();
}

function r_semester() {
    //$("#semester").find("option[value='']").attr('selected', true);
    $("#semester option[value='']").prop("selected", true);
    filter();
}

$(document).on("click", '#remove', function(a) {
    var tag = this.getAttribute("value");
    var values = $('#tags').val();

    $('#tags').selectpicker('deselectAll');
    $('#tags').selectpicker('val', values.filter(function(e) { return e !== tag }));
    $('#tags').selectpicker('refresh');
});

function r_art() {
    //$("#art").find("option[value='']").attr('selected', true);
    $("#art option[value='']").prop("selected", true);
    filter();
}

function r_betreuer() {
    //$("#betreuer").find("option[value='']").attr('selected', true);
    $("#betreuer option[value='']").prop("selected", true);
    filter();
}

function r_semester() {
    //$("#semester").find("option[value='']").attr('selected', true);
    $("#semester option[value='']").prop("selected", true);
    filter();
}

$(document).on("click", '#remove', function(a) {
    var tag = this.getAttribute("value");
    var values = $('#tags').val();

    $('#tags').selectpicker('deselectAll');
    $('#tags').selectpicker('val', values.filter(function(e) { return e !== tag }));
    $('#tags').selectpicker('refresh');
});


$(document).on("click", '#add_tf', function(a) {
    var tag = this.getAttribute("value");
    $('#tags').selectpicker('val', tag);
    $('#tags').selectpicker('refresh');
});

function showVorkenntnisse(thema_id) {
    var xhttp;
    if (thema_id == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    }
    // code for IE6, IE5

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "/ajax/ajax_controller.php?action=showVorkenntnisse&id=" + thema_id, true);
    xhttp.send();
}

function showVorkenntnisseBW(thema_id) {
    var xhttp;
    if (thema_id == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    }
    // code for IE6, IE5
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "/ajax/ajax_controller.php?action=showVorkenntnisseBW&id=" + thema_id, true);
    xhttp.send();
}


// VORKENNTNISSE FÜR BELEGWUNSCH ABSCHLUSS

$(document).on('inserted.bs.tooltip', function(e) {
    var tooltip = $(e.target).data('bs.tooltip');
    $(tooltip.tip).addClass($(e.target).data('tooltip-custom-classes'));
});

function showVorkenntnisseBEL1(thema_id) {
    var xmlhttp;
    $("#v1").hide();

    if (thema_id == "") {
        $("#pr1").show();
        document.getElementById("v1").innerHTML = "";
        return;
    } else {
        $("#pr1").hide();
        $("#v1").show();
    }

    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("v1").innerHTML = xmlhttp.responseText;
            $('[data-toggle="tooltip"]').tooltip();
        }
    }
    xmlhttp.open("GET", "/ajax/ajax_controller.php?action=showVorkenntnisseBEL1&id=" + thema_id, true);
    xmlhttp.send();
}


function showVorkenntnisseBEL2(thema_id) {
    var xmlhttp;
    $("#v2").hide();

    if (thema_id == "") {
        $("#pr1").show();
        document.getElementById("v2").innerHTML = "";
        return;
    } else {
        $("#pr1").hide();
        $("#v2").show();
    }

    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("v2").innerHTML = xmlhttp.responseText;
            $('[data-toggle="tooltip"]').tooltip();
        }
    }
    xmlhttp.open("GET", "/ajax/ajax_controller.php?action=showVorkenntnisseBEL2&id=" + thema_id, true);
    xmlhttp.send();
}


function showVorkenntnisseBEL3(thema_id) {
    var xmlhttp;
    $("#v3").hide();

    if (thema_id == "") {
        $("#pr1").show();
        document.getElementById("v3").innerHTML = "";
        return;
    } else {
        $("#pr1").hide();
        $("#v3").show();
    }

    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("v3").innerHTML = xmlhttp.responseText;
            $('[data-toggle="tooltip"]').tooltip();
        }
    }
    xmlhttp.open("GET", "/ajax/ajax_controller.php?action=showVorkenntnisseBEL3&id=" + thema_id, true);
    xmlhttp.send();
}


// ENDE

// archivierung

function archivierung(semester) {
    var xmlhttp;
    $("#archiv").hide();

    if (semester == "") {
        $("#meldung").show();
        document.getElementById("archiv").innerHTML = "";
        return;
    } else {
        $("#meldung").hide();
        $("#archiv").show();
    }

    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("archiv").innerHTML = xmlhttp.responseText;
            $('[data-toggle="tooltip"]').tooltip();
        }
    }
    xmlhttp.open("GET", "/ajax/ajax_controller.php?action=showArchiv&semester=" + semester, true);
    xmlhttp.send();
}
// ende

// ONLY NUMERIC BEI BEWERBUNGEN
$(document).ready(function(e) {
    $('input#onlyNumeric').keydown(function(e) {
        var key = e.which;
        if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
            key >= 48 && key <= 57 || // numbers   
            key >= 96 && key <= 105 || // Numeric keypad
            key == 190 || key == 188 || key == 109 || key == 110 || // comma, period and minus, . on keypad
            key == 8 || key == 9 || key == 13 || // Backspace and Tab and EnterEnd
            key == 35 || key == 36 || // Home and 
            key == 37 || key == 39 || // left and right arrows
            key == 46 || key == 45) // Del and Ins
            return true;

        return false;
    });
});

/*
$(document).ready(function(e) {
    $("input #onlyNumeric").keypress(function(event) {
        return /\d/.test(String.fromCharCode(event.keyCode));
    });
});



$(document).ready(function(e) {
    $('input #onlyNumeric').keypress(function(event) {
        if ($.browser.mozilla == true) {
            if (event.keyCode == 8 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 9 || event.keyCode == 16 || event.keyCode == 46) {
                return true;
            }
        }
        if (event.which < 48 || event.which > 57) {
            event.preventDefault();
        }
    });
}); 

$('input #onlyNumeric').on('keypress', function(event) {
    var isAlphaNum = String.fromCharCode(event.charCode).match(/[a-zA-Z0-9]/);

});*/

// ende