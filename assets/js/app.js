const bootstrap = require('bootstrap');

const $ = require('jquery');


$(function () {

    $('div.close i.material-icons, .overlay').on('click', function () {
        $('#sidebar-wrapper').removeClass('active');
        $('.overlay').fadeOut();
    });

    $('a.menu-icon').on('click', function () {
        $('#sidebar-wrapper').addClass('active');
        $('.overlay').fadeIn();
    });
});
