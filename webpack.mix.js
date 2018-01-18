const { mix }  = require('laravel-mix');

mix.setPublicPath('./public_html');

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




mix.js('resources/assets/js/common.js', 'public_html/js')
   .sass('resources/assets/sass/app.scss', 'public_html/css')

    //for admin pages
    // .js('resources/assets/js/admin.js', 'public_html/js')
   // .sass('resources/assets/sass/admin.scss', 'public_html/css')
    .version();
