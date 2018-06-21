const bootstrap = require('bootstrap');

const $ = require('jquery');

const datepicker = require('bootstrap-datepicker');


$(function () {

    $('div.close i.material-icons, .overlay').on('click', function () {
        $('#sidebar-wrapper').removeClass('active');
        $('.overlay').fadeOut();
    });

    $('a.menu-icon').on('click', function () {
        $('#sidebar-wrapper').addClass('active');
        $('.overlay').fadeIn();
    });

    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
    });

    $.fn.datepicker.dates['fr'] = {
        days: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
        daysShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
        daysMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
        months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
        monthsShort: ["Jan", "Fév", "Mar", "Avr", "Mai", "Jun", "Jui", "Aoû", "Sep", "Oct", "Nov", "Déc"],
        format: "dd/mm/yyyy",
        titleFormat: "MM yyyy",
        weekStart: 0
    };

    $('.datepicker').datepicker({
        format: "dd/mm/yyyy", // Format
        // startDate: "new Date()", // Start date of calendar
        endDate: "new Date()",
        language: "fr",
        multidate: false,
        keyboardNavigation: false,
        autoclose: true,
        todayHighlight: true,
        toggleActive: true
    });

});


