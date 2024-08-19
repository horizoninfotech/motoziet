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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');

// Copy AdminLTE assets to the public directory
mix.copy('node_modules/admin-lte/dist/css/adminlte.min.css', 'public/vendor/adminlte/dist/css')
   .copy('node_modules/admin-lte/dist/js/adminlte.min.js', 'public/vendor/adminlte/dist/js')
   .copyDirectory('node_modules/admin-lte/plugins', 'public/vendor/adminlte/plugins');

// Optionally, you can include AdminLTE skins (if you're using them)
mix.copy('node_modules/admin-lte/dist/css/skins', 'public/vendor/adminlte/dist/css/skins');
