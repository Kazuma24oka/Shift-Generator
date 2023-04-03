const mix = require('laravel-mix');

mix.scripts('node_modules/popper.js/dist/umd/popper.js', 'public/js')
    .scripts([
        'node_modules/bootstrap/dist/js/bootstrap.js',
        'resources/js/app.js',
    ], 'public/js/app.js')
    .sourceMaps(false) // ここに追加する
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [
            require('autoprefixer')({
                grid: true,
                browsers: ['last 2 versions', 'iOS >= 8', 'Android >= 4.1', 'ie >= 11'],
            }),
        ],
        sassOptions: {
            includePaths: ['node_modules/bootstrap/scss', 'resources/sass'],
        },