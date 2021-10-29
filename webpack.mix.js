const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
])
.styles('resources/views/assets/css/styles.css', 'public/assets/css/styles.css')
.copyDirectory('resources/views/assets/plugins','public/assets/plugins')
.scripts('resources/views/assets/js/jquery.min.js', 'public/assets/js/jquery.min.js')
.scripts('resources/views/assets/js/scripts.js', 'public/assets/js/scripts.js')
.scripts('resources/views/assets/js/jquery.form.js', 'public/assets/js/jquery.form.js')
;
