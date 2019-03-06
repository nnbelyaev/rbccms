const mix = require('laravel-mix');

mix.sass('resources/sass/front.scss', 'public/css')
   .sass('resources/sass/app.scss', 'public/css').version();

mix.disableSuccessNotifications();