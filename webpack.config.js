var Encore = require('@symfony/webpack-encore');

Encore

    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    // .enableSourceMaps(!Encore.isProduction())

    // .enableVersioning(Encore.isProduction())
    // .addEntry('js/app', './assets/js/app.js')
    // .addStyleEntry('css/app', './assets/css/app.scss')
    .enableSassLoader()
    // uncomment for legacy applications that require $/jQuery as a global variable
    .autoProvidejQuery()
    .addEntry('js/app', './assets/js/app.js')
    .addStyleEntry('css/app', ['./assets/scss/global.scss'])
    
;

module.exports = Encore.getWebpackConfig();
