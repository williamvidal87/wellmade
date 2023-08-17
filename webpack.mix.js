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

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);

if (mix.inProduction()) {
    mix.version();
}

mix.styles([
    'resources/admin/css/bootstrap.min.css',
    'resources/admin/css/nifty.min.css',
    'resources/admin/css/demo/nifty-demo-icons.min.css',
    'resources/admin/plugins/pace/pace.min.css',
    'resources/admin/css/demo/nifty-demo.min.css',
    'resources/admin/plugins/font-awesome/css/font-awesome.min.css',
    'resources/admin/plugins/ionicons/css/ionicons.min.css',
    'resources/admin/plugins/themify-icons/themify-icons.min.css',
    'resources/admin/plugins/select2/css/select2.min.css',
    'resources/admin/DataTables/datatables.min.css',
],'public/css/main.css')
    .scripts([
        'resources/admin/js/jquery.min.js',
        'resources/admin/js/bootstrap.min.js',
        'resources/admin/js/nifty.min.js',
        'resources/admin/js/demo/nifty-demo.min.js',
        'resources/admin/plugins/pace/pace.min.js',
        'resources/admin/plugins/flot-charts/jquery.flot.min.js',
        'resources/admin/plugins/flot-charts/jquery.flot.resize.min.js',
        'resources/admin/plugins/flot-charts/jquery.flot.tooltip.min.js',
        'resources/admin/plugins/sparkline/jquery.sparkline.min.js',
        'resources/admin/plugins/select2/js/select2.min.js',
        'resources/admin/DataTables/datatables.min.js',
], 'public/js/main.js');
