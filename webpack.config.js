var Encore = require('@symfony/webpack-encore');

const OUTPUT_PATH = 'public/themes';
const PUBLIC_PATH = '/public';

/**
 *
 *
 *
 * Default theme configuration
 *
 *
 *
 */
Encore
    .setOutputPath(OUTPUT_PATH + '/default/assets')
    .setPublicPath(PUBLIC_PATH)
    .addEntry('app', './assets/default/js/main.js')
    .addStyleEntry('common', './assets/default/scss/common.scss')
    .enableSassLoader()
    .autoProvidejQuery()
    .enableSourceMaps(!Encore.isProduction())
;

// build the default theme configuration
const defaultConfig = Encore.getWebpackConfig();

// reset Encore to build the second config
Encore.reset();

/**
 *
 *
 *
 * Admin theme configuration
 *
 *
 *
 */
Encore
    .setOutputPath(OUTPUT_PATH + '/admin/assets')
    .setPublicPath(PUBLIC_PATH)
    .addEntry('app', './assets/admin/js/main.js')
    .addStyleEntry('common', './assets/admin/scss/common.scss')
    .enableSassLoader()
    .autoProvidejQuery()
    .enableSourceMaps(!Encore.isProduction())
;

// build the second configuration
const adminConfig = Encore.getWebpackConfig();

// reset Encore to build the second config
Encore.reset();

/**
 *
 *
 *
 * Auth theme configuration
 *
 *
 *
 */
Encore
    .setOutputPath(OUTPUT_PATH + '/auth/assets')
    .setPublicPath(PUBLIC_PATH)
    .addStyleEntry('common', './assets/auth/scss/common.scss')
    .enableSassLoader()
    .enableSourceMaps(!Encore.isProduction())
;

// build the second configuration
const authConfig = Encore.getWebpackConfig();

// reset Encore to build the second config
Encore.reset();

/**
 *
 *
 *
 * Export the final configuration as an array of multiple configurations
 *
 *
 *
 */
module.exports = [
    defaultConfig,
    adminConfig,
    authConfig
];