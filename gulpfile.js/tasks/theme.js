// ==== THEME ==== //

var gulp        = require('gulp')
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

// Copy PHP source files to the `build` folder
gulp.task('theme-php', function() {
  return gulp.src(config.php.src)
  .pipe(plugins.changed(config.php.dest))
  .pipe(gulp.dest(config.php.dest));
});

// Copy everything under `src/languages` indiscriminately
gulp.task('theme-lang', function() {
  return gulp.src(config.lang.src)
  .pipe(plugins.changed(config.lang.dest))
  .pipe(gulp.dest(config.lang.dest));
});

// All the theme tasks in one
gulp.task('theme', ['theme-lang', 'theme-php', 'theme-fonts', 'theme-readme']);
