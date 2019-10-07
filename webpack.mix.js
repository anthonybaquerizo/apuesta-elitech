let mix = require('laravel-mix');

mix.webpackConfig({
   module: {
     rules: [
       {
         test: /\.pug$/,
         oneOf: [
           {
               resourceQuery: /^\?vue/,
               use: ['pug-plain-loader']
           },
           {
               use: ['raw-loader', 'pug-plain-loader']
           }
         ]
       }
     ]
   },
   resolve: {
     alias: {
         '@': path.resolve(__dirname, 'resources/assets/js'),
         '~': path.resolve(__dirname, 'resources/assets/sass'),
         '@mixin': path.resolve(__dirname, 'resources/assets/js/mixins'),
         '@page': path.resolve(__dirname, 'resources/assets/js/page'),
         '@route': path.resolve(__dirname, 'resources/assets/js/routes'),
         '@store': path.resolve(__dirname, 'resources/assets/js/store'),
         '@views': path.resolve(__dirname, 'resources/assets/js/views'),
         '@components': path.resolve(__dirname, 'resources/assets/js/views/components')
     }
   }
});

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
