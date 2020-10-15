'use strict';
 
const projectUrl = 'kool.test';

const { src, dest, watch, series, parallel } = require('gulp');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');
const browsersync = require('browser-sync').create();
const autoprefixer = require('gulp-autoprefixer');
const plumber = require('gulp-plumber');
const cache = require('gulp-cached');
const include = require('gulp-include');
const sasslint = require('gulp-sass-lint');
const beeper = require('beeper');
const notify = require('gulp-notify');
const concat = require('gulp-concat');


function sassLint() {
  /*, './.build/**//*.js'*/
    return src(['./.build/main.scss', './app/views/**/*.scss'])
      .pipe(cache('sasslint'))
      .pipe(sasslint({
        configFile: '.sass-lint.yml'
      }))
      .pipe(sasslint.format())
      .pipe(sasslint.failOnError());
}

function buildStyles() {
    return src(['./.build/main.scss', './app/views/**/*.scss'])
      .pipe(concat('main.css'))
      .pipe(plumbError())
      .pipe(sourcemaps.init())
      .pipe(sass({ outputStyle: 'compressed' }))
      .pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7']))
      .pipe(sourcemaps.write())
    //   .pipe(rename('main.css'))
      .pipe(dest('./app/layout'))
      .pipe(browsersync.reload({ stream: true }));
}

function buildJS() {
    return src(['./.build/**/*.js', './app/views/**/*.js'])
      .pipe(concat('main.js'))
      .pipe(plumbError())
      .pipe(include())
      // .pipe(sourcemaps.init())
      // .pipe(sourcemaps.write())
      .pipe(dest('./app/layout'))
      // .pipe(browsersync.reload({ stream: true }));
}

function watchFiles() {
    watch(
      ['./.build/*','./.build/**/*','./app/views/**/*', './app/views/*'],
      { events: 'all', ignoreInitial: false },
      series(sassLint, buildStyles, buildJS)
    );
}

function browserSync(done) {
    browsersync.init({
      proxy: projectUrl, // Change this value to match your local URL.
      socket: {
        domain: projectUrl+':3000'
      }
    });
    done();
}

function plumbError() {
    return plumber({
      errorHandler: function(err) {
        notify.onError({
          templateOptions: {
            date: new Date()
          },
          title: "Gulp error in " + err.plugin,
          message:  err.formatted
        })(err);
        beeper();
        this.emit('end');
      }
    })
}
  

exports.default = parallel(browserSync, watchFiles); // $ gulp
exports.sass = buildStyles; // $ gulp sass
exports.watch = watchFiles; // $ gulp watch
exports.build = series(buildStyles); // $ gulp build