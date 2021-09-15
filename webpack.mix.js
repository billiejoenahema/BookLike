const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
  .react()
  .sass("resources/sass/app.scss", "public/css")

mix.scripts([
  'public/js/bookDescription.js',
  'public/js/categorySelectValidate.js',
  'public/js/changeCategory.js',
  'public/js/changeStars.js',
  'public/js/checkInputLoginForm.js',
  'public/js/checkTextLength.js',
  'public/js/deleteCheck.js',
  'public/js/flashMessageFadeout.js',
  'public/js/footerMenuShowHide.js',
  'public/js/formatDate.js',
  'public/js/onLoad.js',
  'public/js/scrollTop.js',
  'public/js/selectItem.js',
  'public/js/showEditProfileButton.js'
], 'public/js/all.js')
