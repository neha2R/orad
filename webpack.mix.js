const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
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

mix.js("resources/js/app.js", "public/js/app.js");

mix.js("resources/js/developer.js", "public/js/developer.js");
mix.sass('resources/scss/app.scss', 'public/css/app.css')
mix.sass('resources/scss/developer.scss', 'public/css/developer.css')

.options({
    postCss: [tailwindcss('./tailwind.config.js')],
})
.version();

// mix.sass('resources/scss/app.scss', 'public/css/app.css');
    // .postCss("resources/scss/app.scss", "public/css", [
    //  require("tailwindcss"),
    // ]);