const mix = require('laravel-mix');

mix.js('resources/js/manage.js', 'public/js') 
   .sass('resources/sass/front.scss', 'public/css')
   .sass('resources/sass/manage.scss', 'public/css').version();

mix.disableSuccessNotifications();