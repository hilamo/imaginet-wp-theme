// Run this command first:
// npm install gulp gulp-uglify gulp-rename gulp-clean-css gulp-autoprefixer gulp-concat gulp-rtlcss gulp-notify

var gulp         = require('gulp'),
    sass         = require('gulp-sass'),
    uglify       = require('gulp-uglify'),
    rename       = require('gulp-rename'),
    cleanCSS     = require('gulp-clean-css'),
    autoprefixer = require('gulp-autoprefixer'),
    concat       = require('gulp-concat'),
    rtlcss       = require('gulp-rtlcss'),
    notify       = require("gulp-notify");

/*******************************
    Define bootstrap Framework
*******************************/
var framework_js = './assets/bootstrap/js/bootstrap.min.js';
var framework_css = './assets/bootstrap/css/bootstrap.min.css';

gulp.task('default', function(){
    console.log("Gulp default started");
});
/**************
Development
**************/
var src_scripts = [
    framework_js,
    './assets/js/jquery.magnific-popup.min.js',
    './assets/js/slick.min.js',
    './assets/js/wow.min.js'
];

gulp.task('js', function(){
    return gulp.src(src_scripts)
    .pipe(concat('assets.js'))
    .pipe(gulp.dest('./js/'))
    .pipe(rename('assets.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./js/'))
    .pipe(notify("Scripts compiled and minified"));
});

var src_styles = [
    framework_css,
    './assets/css/assets.min.css',
    './assets/css/animate.css',
    './assets/css/magnific-popup.css',
    './assets/css/slick.css',
];

gulp.task('css',['js'], function(){
    return gulp.src(src_styles)
    .pipe(concat('assets.css'))
    .pipe(gulp.dest('./css/'))
    .pipe(rename('assets.min.css'))
    .pipe(cleanCSS())
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(gulp.dest('./css/'))
    .pipe(notify("Styles compiled and minified"));
});

gulp.task('sass', ['css'], function() {
    gulp.src('./css/*style.scss') // the src of the file we want to manipulate
        .pipe(sass()) // in the pipe the file is going to be transformed
        // .pipe(cleanCSS())
        .pipe(autoprefixer({
                browsers: ['last 2 versions'],
                cascade: false
        }))
        .pipe(gulp.dest('./css/'))
        .pipe(notify("SASS files were manipulated."));
});

gulp.task('watch', ['sass'], function() {
    gulp.watch('./css/**/*.scss');
});

gulp.task('development', ['watch'], function(){
    console.log("Development scripts & styles compiled!!!");
});

/*********************
    Production
*********************/

var production_scripts = [
    './js/assets.min.js',
    './js/scripts.js'
];

gulp.task('production-js', function() {
    return gulp.src(production_scripts)
      .pipe(concat('production.min.js'))
      .pipe(gulp.dest('./js/'))
      .pipe(uglify())
      .pipe(gulp.dest('./js/'))
      .pipe(notify("Production script compiled and minified"));
});

var production_styles = [
    './css/assets.min.css',
    './css/style.min.css',
    './css/responsive.min.css',
    './css/rtl-style.css'
];

gulp.task('production-css',['production-js'], function() {
    return gulp.src(production_styles)        // move it to build/css/ directory
    .pipe(rename('production.min.css'))       // rename it
    .pipe(cleanCSS())                         // minify css
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(concat('production.min.css'))
    .pipe(gulp.dest('./build/css/'))          // move it again to build/clean/ directory
    .pipe(notify("Production style compiled and minified"));   // notify message
});

gulp.task('production', ['production-css'], function(){
    console.log("Production executed!!!");
});
