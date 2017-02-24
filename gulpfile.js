var gulp = require('gulp');
var gulp = require('gulp-help')(require('gulp'));
var debug = require('gulp-debug');
var browserSync = require('browser-sync').create();

//for scss
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');

//for js
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');

//file paths
var appDirectory ='./app/';
var distDirectory = './dist/';

var paths = {
  scripts:{
      src: appDirectory+'scripts/**/*.js',
      dest: distDirectory+'scripts/'
  },
  styles:{
      src: appDirectory+'styles/**/*.scss',
      dest: distDirectory+'styles/'
  } 
};
 
gulp.task('default', ['help'], function () {

});

gulp.task('sass', 'Compiles .scss files to .css', function () {
    return gulp.src(paths.styles.src)
        .pipe(sourcemaps.init())
        .pipe(sass().on('Sass Error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(paths.styles.dest))
        .pipe(browserSync.stream());
});

gulp.task('scripts', 'Concatenates and minifies js files', function () {
    return gulp.src(paths.scripts.src)
        .pipe(debug({title: 'scripts:'}))
        .pipe(concat('app.js'))
        .pipe(gulp.dest(paths.scripts.dest))
        //.pipe(rename('app.min.js'))
        //.pipe(uglify())
        .pipe(gulp.dest(paths.scripts.dest))
        .pipe(browserSync.stream());
});

gulp.task('serve', "Serves the app to localhost", ['sass','scripts'], function () {

    browserSync.init({
        server: {
            baseDir: "./"
        }
    });

    gulp.watch(paths.styles.src, ['sass']);
    gulp.watch(paths.scripts.src, ['scripts']);
    gulp.watch('./**/*.html').on('change', browserSync.reload);
});