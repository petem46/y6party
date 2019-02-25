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
var $ = require("jquery");

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

   mix.copyDirectory('node_modules/jquery.easing/jquery.easing.min.js', 'public/js');
   mix.copyDirectory('node_modules/jquery/dist/jquery.min.js', 'public/js');
   mix.copyDirectory('node_modules/popper.js/dist/umd/popper.min.js', 'public/js');
   mix.copyDirectory('node_modules/scrolltrigger-classes/Scrolltrigger.min.js', 'public/js');
//    mix.copyDirectory('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/js');
//    mix.copyDirectory('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css');
//    mix.copyDirectory('node_modules/bootstrap-material-design/dist/css/bootstrap-material-design.min.css', 'public/css');
//    mix.copyDirectory('node_modules/bootstrap-material-design/dist/js/bootstrap-material-design.min.js', 'public/js');
//    mix.copyDirectory('node_modules/bootstrap-material-design/scss', 'resources/sass')


