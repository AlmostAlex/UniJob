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


var citynames = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: {
        url: 'assets/citynames.json',
        filter: function(list) {
            return $.map(list, function(cityname) {
                return { name: cityname };
            });
        }
    }
});
citynames.initialize();

$('input').tagsinput({
    typeaheadjs: {
        name: 'citynames',
        displayKey: 'name',
        valueKey: 'name',
        source: citynames.ttAdapter()
    }
});



/*
$(document).on('click', '.tag', function() {
    var tagsInput = $('input[data-role="tagsinput"]');
    var valuesStr = tagsInput.val();
    var values = valuesStr.split(',');

    var bootstrapTagsInput = $('.bootstrap-tagsinput');
    var input = bootstrapTagsInput.find('input');
    var index = bootstrapTagsInput.children().index($(this));
    value = values[index];

    var htmlStr = '<span class="tag label label-info" id="js-edit-container">' +
        '<input type="text" class="form-control" id="js-edit-input">' +
        '</span>'
    $(this).after(htmlStr);
    $(this).hide();
    input.hide();

    var editContainer = $('#js-edit-container');
    var editInput = $('#js-edit-input');
    editContainer.data('value', value);
    editInput.val(value);
    editInput.focus();
});

$(document).on('focusout', '#js-edit-input', function() {
    var bootstrapTagsInput = $('.bootstrap-tagsinput');
    var editContainer = $('#js-edit-container');
    var tags = bootstrapTagsInput.children();
    var index = tags.index(editContainer);

    var tagsInput = $('input[data-role="tagsinput"]');
    var values = tagsInput.val().split(',');

    var value = $(this).val();
    var defaultValue = editContainer.data('value');
    var value = value || defaultValue;

    var input = bootstrapTagsInput.find('input');

    editContainer.remove();
    values[index - 1] = value;
    tagsInput.tagsinput('removeAll');

    for (var i = 0; i < values.length; i++) {
        tagsInput.tagsinput('add', values[i]);
    }

    input.show();
    input.focus();
});

$("input").focusout(function() {

    if (this.value.length > 0) {
        this.style.width = ((this.value.length + 1) * 8) + 'px';
    } else {
        this.style.width = ((this.getAttribute('placeholder').length + 1) * 8) + 'px';
    }

}); */