var Encore = require('@symfony/webpack-encore');

const ASSETS_PATH = './assets';
const PUBLIC_PATH = '/public';
const OUTPUT_PATH = 'public/themes';

/**
 * Templates to load
 *
 * @type {*[]}
 */
let templates = [
    {
        folder: 'default',
        scssEntry: true,
        jsEntry: true,
        jquery: true
    },
    {
        folder: 'admin',
        scssEntry: true,
        jsEntry: true,
        jquery: true
    }
];

let configs = [];

templates.forEach(function (c) {
    Encore
        .setOutputPath(OUTPUT_PATH + '/' + c.folder + '/assets')
        .setPublicPath(PUBLIC_PATH)
    ;

    if (c.scssEntry) {
        Encore
            .addStyleEntry('common', ASSETS_PATH + '/' + c.folder + '/scss/common.scss')
            .enableSassLoader()
        ;
    }

    if (c.jsEntry) {
        Encore
            .addEntry('app', ASSETS_PATH + '/' + c.folder + '/js/main.js')
        ;

        if (c.jquery) {
            Encore
                .autoProvidejQuery()
            ;
        }
    }

    Encore.enableSourceMaps(!Encore.isProduction());

    // build the default theme configuration
    configs.push(Encore.getWebpackConfig());

    // reset Encore to build another config
    Encore.reset();
});

/**
 *
 *
 *
 * Export the final configuration as an array of multiple configurations
 *
 *
 *
 */
module.exports = configs;