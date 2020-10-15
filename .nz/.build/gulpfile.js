'use strict';

var envdev 		= true;
var js_vendor = false;

var fs 			= require('fs');
var path 		= require('path');
var forEach = require("for-each");

var ssl_folder 			= path.join(__dirname, '/../../../../.dev/.apache/common/ssl/');
var vendor_folder 	= path.join(__dirname, '/../../../../assets/vendor/');
var top_folder 			= path.join(__dirname, '/../../../../');
var dist_folder 		= path.join(__dirname, './../layout/assets/');
var js_folder 			= path.join(__dirname, '/app/');

var gulp 				= require('gulp')
	, sourcemaps 	= require('gulp-sourcemaps')
	, babel 			= require('gulp-babel')
	, ckbuilder 	= require('gulp-ckbuilder')
	, plumber 		= require('gulp-plumber')
	, include 		= require('gulp-include')
	, rename 			= require('gulp-rename')
	, uglify 			= require('gulp-uglifyjs')
	, minify 			= require('gulp-minify')
	, sass 				= require('gulp-sass')
	, cleanCSS		= require('gulp-clean-css')
	, bs 					= require('browser-sync')
;

require('events').EventEmitter.prototype._maxListeners = 58;

const quick_dev = true;

gulp.task('ckeditor', function() {

	var ckeditor_build_folder = vendor_folder + 'ckeditor/build/'
		, ckeditor_dist_folder 	= dist_folder + 'ckeditor/'
		, options = {
			overwrite		: true,
			version			: '4.9.1',
			revision		: '72a83a5',
			buildConfig	: ckeditor_build_folder + 'build-config.js'
		}
	;
	return gulp.src('').pipe(ckbuilder(ckeditor_build_folder, ckeditor_dist_folder, options));
});

gulp.task('sync', ['vendor', 'sass', 'js'], function() {
	if(quick_dev) return;
	process.stdin.resume();
	process.on('SIGINT', function () {
		gulp.start('production', function(){
	  	process.exit(1);		
		});  
	});
});

gulp.task('js', function() {
	return gulp.src('@main.js')
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(include({includePaths: js_folder}))
	  .pipe(rename('dev.js'))
	  .pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(dist_folder))
	;
});

gulp.task('compile:js', function() {
	var debug = false;
	return gulp.src('@app.js')
		.pipe(sourcemaps.init())
		.pipe(include({includePaths: [__dirname, vendor_folder, js_folder]}))
		.pipe(babel({
			comments: false,
			compact: true,
			minified: true,
			babelrc: false
		}))
		.pipe(rename('app.js'))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(dist_folder))
	;
});

gulp.task('vendor', function() {
	var debug = false;
	return gulp.src('@vendor.js')
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(include({includePaths: vendor_folder}))
		.pipe(babel({
			comments: false,
			compact: true,
			minified: true,
			babelrc: false
		}))
		.pipe(rename('vendor.js'))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(dist_folder))
	;
});

var brand = '', includePaths = [__dirname, vendor_folder];

gulp.task('vendor', function() {
	var debug = false;
	return gulp.src('@vendor'+brand+'.js')
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(include({includePaths: includePaths}))
		.pipe(babel({
			comments: false,
			compact: true,
			minified: true,
			babelrc: false
		}))
		.pipe(rename('vendor'+brand+'.js'))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(dist_folder))
	;
});

gulp.task('vendor-dev', function() {
	var debug = false;
	return gulp.src('@vendor'+brand+'.js')
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(include({includePaths: includePaths}))
		.pipe(rename('vendor'+brand+'-dev.js'))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(dist_folder))
	;
});

gulp.task('compile:vendor', ['vendor-dev', 'vendor']);

gulp.task('production', ['compile:js', 'vendor']);

gulp.task('qyt', function() {
	brand = '-qyt'
	includePaths.push(path.join(top_folder, 'projects/inmediative/qyt-s2/nz/layout/'));
	return gulp.start('vendor');
});

gulp.task('qyt:dev', function() {
	brand = '-qyt'
	return gulp.start('vendor-dev');	
});

gulp.task('prod', function() {
	return gulp.start('production');
});
