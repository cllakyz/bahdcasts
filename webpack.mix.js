let mix = require('laravel-mix');

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

/*mix.js('resources/assets/js/app.js', 'public/assets/js/app.js')
   .sass('resources/assets/sass/app.scss', 'public/assets/css/app.css');*/

mix.js('resources/assets/js/app.js', 'public/assets/js/app.js');

mix.styles([
    'resources/assets/css/core.min.css',
    'resources/assets/css/thesaas.min.css',
    'resources/assets/css/style.css',
], 'public/assets/css/bahdcasts.css')
    .js([
        'resources/assets/js/core.min.js',
        'resources/assets/js/thesaas.min.js',
        'resources/assets/js/script.js',
    ], 'public/assets/js/bahdcasts.js');
