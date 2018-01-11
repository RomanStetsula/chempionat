var gulp = require('gulp');
var concat = require('gulp-concat');
var uglifycss = require('gulp-uglifycss');


gulp.task('css', function () {
  gulp.src('storage/app/public/css/*.css')
    .pipe(concat('all.css'))
    .pipe(uglifycss({
      "maxLineLen": 80,
      "uglyComments": true
    }))
    .pipe(gulp.dest('public_html/css/'));
});

gulp.task('js', function () {
  gulp.src('storage/app/public/js/*.js')
    .pipe(concat('all.js'))
    .pipe(gulp.dest('public_html/js/'));
});
