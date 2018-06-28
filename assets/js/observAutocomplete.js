const $ = require('jquery');
require('webpack-jquery-ui/autocomplete');
require('webpack-jquery-ui/css');

$("#observation_bird_lbNom").autocomplete({
    source: lbNomUrl,
    minLength: 2,
    select: function (event, ui) {
        $("#observation_bird_lbNom").val(ui.item.value);
        return false;
    },
    change: function (event, ui) {
        $("#observation_bird_lbNom").val(ui.item ? ui.item.value : $(this).val());
    }
});

$("#observation_bird_nomVern").autocomplete({
    source: vernNomUrl,
    minLength: 2,
    select: function (event, ui) {
        $("#observation_bird_nomVern").val(ui.item.value);
        return false;
    },
    change: function (event, ui) {
        $("#observation_bird_nomVern").val(ui.item ? ui.item.value : $(this).val());
    }
});