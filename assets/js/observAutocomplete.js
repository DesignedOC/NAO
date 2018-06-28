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

$("#observation_bird_nomVern, #input-nom-vern").autocomplete({
    source: vernNomUrl,
    minLength: 2,
    select: function (event, ui) {
        $("#observation_bird_nomVern, #input-nom-vern").val(ui.item.value);
        return false;
    },
    change: function (event, ui) {
        $("#observation_bird_nomVern, #input-nom-vern").val(ui.item ? ui.item.value : $(this).val());
    }
});