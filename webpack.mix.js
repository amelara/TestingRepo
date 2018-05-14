let mix = require('laravel-mix');
let webpack = require('webpack');

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

mix.webpackConfig({
    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery',
            Popper: ['popper.js', 'default']
        })
    ]})
	.js('resources/assets/js/app.js', 'public/js')
    .styles([ 'node_modules/owl.carousel/dist/assets/owl.carousel.css', 'node_modules/owl.carousel/dist/assets/owl.theme.default.css' ], 'resources/assets/sass/_dependencies.scss')
   	.sass('resources/assets/sass/app.scss', 'public/css');
