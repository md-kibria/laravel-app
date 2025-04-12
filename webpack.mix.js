const mix = require('laravel-mix');

mix.styles([
    'public/build/bootstrap.min.css',
    'public/build/icons.min.css',
    'public/build/app.min.css',
    'public/build/custom.min.css'
], 'public/build/css/all.css'); // Merges and outputs all CSS into one file

// mix.scripts([
//     'resources/libs/bootstrap/bootstrap.bundle.min.js',
//     'resources/libs/simplebar/simplebar.min.js',
//     'resources/js/plugins.js'
// ], 'public/build/js/all.js'); // Merges and outputs all JS into one file

mix.version(); // Enables cache busting in production
