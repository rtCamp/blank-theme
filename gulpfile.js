// Load plugins
var gulp = require('gulp');

// Plugins related to styles
var sass = require('gulp-sass');
var autoprefixer	= require('gulp-autoprefixer'); // Concatenates JS files
var cmq				= require('gulp-combine-media-queries');//Combine media queries


// Plugins related to JS
var concat			= require('gulp-concat'); // Concatenates JS files
var uglify			= require('gulp-uglify'); // Minifies JS files


//Plugin to Notify after task completed
var notify			= require('gulp-notify'); // Notify after completing tasks


//Plugins to Check text domain
var checktextdomain = require('gulp-checktextdomain'); //Check textdomain


// Plugins realted image.
var imagemin		= require('gulp-imagemin'); // Minify PNG, JPEG, GIF and SVG images with imagemin.


//Plugins related to language translation
var wpPot			= require('gulp-wp-pot');
var sort			= require('gulp-sort'); // Recommended to prevent unnecessary changes in pot-file.


//Plugins to watch tasks
var watch			= require('gulp-watch');



// Browsers you care about for autoprefixing.
const AUTOPREFIXER_BROWSERS = ['last 2 versions', 'ie 9', 'ios 6', 'android 4'];


//Default tasks
gulp.task('default', ['translate','checktextdomain','watch']);
//gulp.task('default', ['sass','scripts','images','checktextdomain','translate','watch']);


// Watch tasks
gulp.task('watch', function() {
  gulp.watch('./sass/**/*.{scss,sass}' , ['sass']);
  gulp.watch([ './js/src/*.js', './js/vendor/*.js'], ['scripts']);
});


// Styles
gulp.task('sass', function() {
  return gulp.src('./sass/style.scss')
	.pipe(autoprefixer(AUTOPREFIXER_BROWSERS))
	.pipe(sass.sync().on('error', sass.logError))
	.pipe(gulp.dest('.'))
	.pipe( notify( { message: 'TASK: "sass" Completed!', onLast: true } ) );
});



// Site Scripts
gulp.task('scripts', function() {
  return gulp.src([
					'js/vendor/navigation.js',
					'js/vendor/slick.js',
					'js/vendor/jquery.mmenu.min.all.js',
					'js/src/main.js'
				])
	.pipe(concat('main.min.js'))
	.pipe(uglify())
	.pipe(gulp.dest('./js/'))
	.pipe( notify( { message: 'TASK: "scripts" Completed!', onLast: true } ) );
});


//POT generations
 gulp.task( 'translate', function () {
     return gulp.src( ['**/*.php', './*.php'] )
         .pipe(sort())
         .pipe(wpPot( {
             domain        : 'blank-theme',
             destFile      : 'blank-theme.pot',
             package       : 'blank-theme',
             bugReport     : 'http://community.rtcamp.com/c/premium-themes',
             lastTranslator: 'Team <support@blank-theme.com>',
             team          : 'Team <support@blank-theme.com>'
         } ))
        .pipe(gulp.dest('./languages/'))
        .pipe( notify( { message: 'TASK: "translate" Completed! 💯', onLast: true } ) )

 });
 
 //Checktextdomain in php files
 gulp.task('checktextdomain', function() {
    return gulp
    .src(['**/*.php', './*.php'])
    .pipe(checktextdomain({
        text_domain: 'blank-theme', //Specify allowed domain(s) 
        keywords: [ //List keyword specifications
					'__:1,2d',
					'_e:1,2d',
					'_x:1,2c,3d',
					'esc_html__:1,2d',
					'esc_html_e:1,2d',
					'esc_html_x:1,2c,3d',
					'esc_attr__:1,2d',
					'esc_attr_e:1,2d',
					'esc_attr_x:1,2c,3d',
					'_ex:1,2c,3d',
					'_n:1,2,4d',
					'_nx:1,2,4c,5d',
					'_n_noop:1,2,3d',
			  		'_nx_noop:1,2,3c,4d'
				]
    }))
	.pipe( notify( { message: 'TASK: "checktextdomain" Completed!', onLast: true } ) );
});

// Combine different media queries into one in css files
gulp.task('cmq', function () {
  return gulp.src('*.css')
    .pipe(cmq({
      log: false
    }))
    .pipe(gulp.dest('.'))
	.pipe( notify( { message: 'TASK: "checktextdomain" Completed!', onLast: true } ) );
});

// Images
gulp.task('images', function() {
  return gulp.src('assets/img/*')
	.pipe(imagemin({ optimizationLevel: 7, progressive: true, interlaced: true }))
	.pipe(gulp.dest('assets/img'))
	.pipe( notify( { message: 'TASK: "images" Completed!', onLast: true } ) );;
});

