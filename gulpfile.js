'use strict';

var gulp        = require('gulp'),    
    pagespeed   = require('psi'),
    browserSync = require('browser-sync'),
    gulpif      = require('gulp-if'),
    minifyHTML  = require('gulp-minify-html'),
    neat        = require('node-bourbon'),
    minifycss   = require('gulp-minify-css'),
    neat        = require('node-neat').includePaths,
    plugins     = require('gulp-load-plugins')(),
    reload      = browserSync.reload,
    sass        = require('gulp-sass'),

    env,
    jsSources,
    sassSources,
    htmlSources,
    outputDir,
    imageSources,
    sassStyle,
 
    supportedBrowsers = [
    'chrome >= 34',
    'ff >= 30',
    'safari >= 7',
    'ios >= 7',
    'android >= 4.4',
    'ie >= 10',
    'ie_mob >= 10',
    'opera >= 23',
    'bb >= 10'
];

env = 'development';

if (env==='development') {
  outputDir = 'builds/development/';
  sassStyle = 'expanded';
} else {
  outputDir = 'builds/production/';
  sassStyle = 'compressed';
}

jsSources     = ['components/scripts/**/*.js'];
sassSources   = ['components/sass/**/*.scss'];
htmlSources   = [outputDir + '*.html'];
imageSources  = ['builds/development/images/**/*'];

gulp.task('js', function() {
  gulp.src(jsSources)
    .pipe(plugins.concat('script.js'))
    .pipe(plugins.browserify())
    .pipe(gulpif(env === 'production', plugins.uglify()))
    .pipe(gulp.dest(outputDir + 'js'))
});

// Optimize Images
gulp.task('images', function () {
  return gulp.src(imageSources)
    .pipe(plugins.cache(plugins.imagemin({
      progressive: true,
      optimizationLevel: 7,
      interlaced: true
    })))
    .pipe(gulpif(env === 'production', gulp.dest(outputDir+'images')))
    .pipe(plugins.size({title: 'images'}));
});

gulp.task('sass', function () {
  return gulp.src(['components/sass/style.scss'])
    .pipe(plugins.changed('sass', {extension: '.scss'}))
    .pipe(sass({
      includePaths: ['scss'],
      precision: 10,
      errLogToConsole: true
    }))
    .pipe(minifycss())
    .pipe(plugins.autoprefixer({browsers: supportedBrowsers}))
    .pipe(gulp.dest( outputDir + 'css'));
});

gulp.task('html', function() {
  gulp.src('builds/development/*.html')
    .pipe(gulpif(env === 'production', minifyHTML()))
    .pipe(gulpif(env === 'production', gulp.dest(outputDir)));
});


gulp.task('browser-sync', function() {  
    browserSync.init([
      './builds/development/css/style.css',
      './builds/development/js/script.js',
      './builds/development/index.html'//,
//      './builds/development/work.html'
    ],
    {
      logLevel: "debug",
      notify: false,
      logPrefix: 'Portfolio',
      //use proxy if you need PHP, etc.
      server: {
          baseDir: "./builds/development"
      }
    });
});

// Watch files and reload on change
gulp.task('watch', ['sass', 'browser-sync'], function () {
  gulp.watch(htmlSources, ['html']);
  gulp.watch(sassSources, ['sass']);
  gulp.watch(jsSources, ['js']);
  gulp.watch(imageSources, ['images']);
});

gulp.task('default', ['sass', 'js', 'images', 'html']);

