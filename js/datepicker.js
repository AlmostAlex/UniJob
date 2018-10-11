 $(function() {
     $("#datepicker_Start").datepicker($.extend({}, $.datepicker.regional["de"], {
         prevText: '&#x3c;zurück',
         prevStatus: '',
         prevJumpText: '&#x3c;&#x3c;',
         prevJumpStatus: '',
         nextText: 'Vor&#x3e;',
         nextStatus: '',
         nextJumpText: '&#x3e;&#x3e;',
         nextJumpStatus: '',
         currentText: 'heute',
         currentStatus: '',
         todayText: 'heute',
         todayStatus: '',
         clearText: '-',
         clearStatus: '',
         closeText: 'schließen',
         closeStatus: '',
         monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
             'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'
         ],
         monthNamesShort: ['Jan', 'Feb', 'Mär', 'Apr', 'Mai', 'Jun',
             'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'
         ],
         dayNames: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
         dayNamesShort: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
         dayNamesMin: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
         showButtonPanel: true,
         altField: "#datepicker_input",
         dateFormat: "dd-mm-yy"
     }));
 });

 $(function() {
     $("#datepicker_Ende").datepicker($.extend({}, $.datepicker.regional["de"], {
         prevText: '&#x3c;zurück',
         prevStatus: '',
         prevJumpText: '&#x3c;&#x3c;',
         prevJumpStatus: '',
         nextText: 'Vor&#x3e;',
         nextStatus: '',
         nextJumpText: '&#x3e;&#x3e;',
         nextJumpStatus: '',
         currentText: 'heute',
         currentStatus: '',
         todayText: 'heute',
         todayStatus: '',
         clearText: '-',
         clearStatus: '',
         closeText: 'schließen',
         closeStatus: '',
         monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
             'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'
         ],
         monthNamesShort: ['Jan', 'Feb', 'Mär', 'Apr', 'Mai', 'Jun',
             'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'
         ],
         dayNames: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
         dayNamesShort: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
         dayNamesMin: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
         showButtonPanel: true,
         altField: "#datepicker_input",
         dateFormat: "dd-mm-yy"
     }));
 });

 $(function() {
    $("#datepicker_kickoff").datepicker($.extend({}, $.datepicker.regional["de"], {
        prevText: '&#x3c;zurück',
        prevStatus: '',
        prevJumpText: '&#x3c;&#x3c;',
        prevJumpStatus: '',
        nextText: 'Vor&#x3e;',
        nextStatus: '',
        nextJumpText: '&#x3e;&#x3e;',
        nextJumpStatus: '',
        currentText: 'heute',
        currentStatus: '',
        todayText: 'heute',
        todayStatus: '',
        clearText: '-',
        clearStatus: '',
        closeText: 'schließen',
        closeStatus: '',
        monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
            'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'
        ],
        monthNamesShort: ['Jan', 'Feb', 'Mär', 'Apr', 'Mai', 'Jun',
            'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'
        ],
        dayNames: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
        dayNamesShort: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
        dayNamesMin: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
        showButtonPanel: true,
        altField: "#datepicker_input",
        dateFormat: "dd-mm-yy"
    }));
});