'use strict';
var gulp 				  = require('gulp');
var sass 				  = require('gulp-sass');

gulp.task('sync', function() {
  gulp.watch("*.scss", ['sass']);
});

gulp.task('sass', function() {
  return gulp.src('*.scss')
    .pipe(sass())
    .pipe(gulp.dest('../../layout/'))
});

gulp.task('default', ['sync']);
