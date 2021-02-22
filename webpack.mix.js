const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.styles([
    'public/web/css/fontawesome/all.min.css',
    // 'public/web/css/monserrat.css',
    'public/web/css/bootstrap.min.css'
], 'public/web/assets/main.min.css');

mix.styles([
    'public/admins/vendor/leaflet/leaflet.css',
    'public/admins/vendor/leaflet/clusters/MarkerCluster.css',
    'public/admins/vendor/leaflet/clusters/MarkerCluster.Default.css',
    'public/admins/vendor/leaflet/geosearch/geosearch.css',
    'public/admins/vendor/lobibox/Lobibox.min.css'
], 'public/web/assets/plugins.min.css');

mix.scripts([
    'public/web/js/jquery-3.4.1.min.js',
    'public/web/js/popper.min.js',
    'public/web/js/bootstrap.min.js'
], 'public/web/assets/main.min.js');

mix.scripts([
    'public/admins/vendor/lazyload/lazyload.min.js',
    'public/admins/vendor/touchSwipe/jquery.touchSwipe.min.js',
    'public/admins/vendor/leaflet/leaflet.js',
    'public/admins/vendor/leaflet/clusters/leaflet.markercluster.js',
    'public/admins/vendor/leaflet/geosearch/bundle.min.js',
    'public/admins/vendor/validate/jquery.validate.js',
    'public/admins/vendor/validate/additional-methods.js',
    'public/admins/js/validate.js',
    'public/admins/vendor/lobibox/Lobibox.js',
], 'public/web/assets/plugins.min.js');