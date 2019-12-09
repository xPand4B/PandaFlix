const mix = require('laravel-mix');

module.exports = {
    optimization: {
        splitChunks: {
            chunks: 'all'
        }
    }
};

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
