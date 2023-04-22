const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .copy('node_modules/moment/min/moment.min.js', 'public/js')
   .copy('node_modules/fullcalendar/dist/fullcalendar.min.js', 'public/js')
   .copy('node_modules/fullcalendar/dist/locale-all.min.js', 'public/js')
   .copy('node_modules/fullcalendar/dist/fullcalendar.min.css', 'public/css');