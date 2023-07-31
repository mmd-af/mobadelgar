const mix = require('laravel-mix');

 mix.js('resources/js/admin/app.js', 'public/build/js/admin.js')
   .sass('resources/css/admin/app.scss', 'public/build/css/admin.css')
.js('resources/js/site/app.js', 'public/build/js/site.js')
   .sass('resources/css/site/app.scss', 'public/build/css/site.css');

// .copy('resources/js/lib/', 'public/js/lib/')
// .copy('resources/files/', 'public/');

