// ==== THEME ==== //

var gulp        = require('gulp')
  , gutil       = require('gulp-util')
  , phpcbf      = require('gulp-phpcbf')
  , plugins     = require('gulp-load-plugins')({ camelize: true })
  , config      = require('../../gulpconfig').theme
;

// Copy readme file to the `build` folder
gulp.task('theme-readme', function() {
  return gulp.src(config.readme.src)
  .pipe(plugins.changed(config.readme.dest))
  .pipe(gulp.dest(config.readme.dest));
});

// Copy custom font files to the `build` folder
gulp.task('theme-fonts', function() {
  return gulp.src(config.fonts.src)
  .pipe(plugins.changed(config.fonts.dest))
  .pipe(gulp.dest(config.fonts.dest));
});

gulp.task('theme-php', function () {
  return gulp.src(config.php.src)
  .pipe(phpcbf({
    bin: config.php.bin
  , standard: config.php.standard
  , warningSeverity: config.php.warning
  }))
  .on('error', gutil.log)
  .pipe(gulp.dest(config.php.dest));
});

// Copy composer dependency files to the `build` folder
gulp.task('theme-composer', function() {
  return gulp.src(config.composer.src)
  .pipe(plugins.changed(config.composer.dest))
  .pipe(gulp.dest(config.composer.dest));
});

// Copy everything under `src/languages` indiscriminately
gulp.task('theme-lang', function() {
  return gulp.src(config.lang.src)
  .pipe(plugins.changed(config.lang.dest))
  .pipe(gulp.dest(config.lang.dest));
});

// All the theme tasks in one
gulp.task('theme', ['theme-lang', 'theme-php', 'theme-fonts', 'theme-readme']);
