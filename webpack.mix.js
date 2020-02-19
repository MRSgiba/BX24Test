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

mix.js('resources/js/bx24/v1/main.js', 'public/js/bx24/v1/')
    .js('resources/js/bx24/v1/install.js', 'public/js/bx24/v1/')
    .sass('resources/sass/bx24/v1/main.scss', 'public/css/bx24/v1/')
    .version();
