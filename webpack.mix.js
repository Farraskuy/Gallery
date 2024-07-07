// webpack.mix.js
let mix = require('laravel-mix');
var LiveReloadPlugin = require('webpack-livereload-plugin');

mix.js('src/app.js', 'dist').setPublicPath('dist');

mix.webpackConfig({
    plugins: [new LiveReloadPlugin()]
});

mix.browserSync('127.0.0.1:8000');