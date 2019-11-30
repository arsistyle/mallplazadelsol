let gulp = require('gulp');
let babel = require('gulp-babel');
let beautify = require('gulp-beautify');
let wait = require('gulp-wait');
let rename = require('gulp-rename');
let concat = require('gulp-concat');
let uglify = require('gulp-uglify');

const gulpJs = (name, path, juntar, end) => {
  return gulp.src(juntar || [`./gulp-files/js/${name}/${name}.js`])
    .pipe(wait(200))
    .pipe(concat(`${name}.js`))
    .pipe(gulp.dest(path || './assets/js'))
    .pipe(babel())
    .pipe(beautify({
      'indent_size': 2
    }))
    .pipe(rename(`${name}.js`))
    .pipe(gulp.dest(path || './assets/js'))
    .on('end', end);
};

const minJS = () => {
  let init = console.log('-->-->---> Se está creando el archivo alljs.min.js ...');
  function msj () {
    return console.log('---------> Se creó el archivo alljs.min.js');
  }
  return gulp.src([
    './assets/js/polyfill.js',
    './assets/js/jquery-3.3.1.js',
    './assets/js/jquery-ui.js',
    './assets/js/lozad.js',
    './assets/js/rellax.js',
    './assets/js/jquery.fancybox.js',
    './assets/js/owl.carousel.js',
    './assets/js/functions.js'
  ])
    .pipe(concat('alljs.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./js'))
    .on('end', msj);
};


const functionsJs = (end) => gulpJs('functions', null, null, minJS);

gulp.task('js', () => {

  function hora (date, path) {
    let _date = date;
    let _hora = _date.getHours() < 10 ? `0${_date.getHours()}` : _date.getHours();
    let _minutos = _date.getMinutes() < 10 ? `0${_date.getMinutes()}` : _date.getMinutes();
    let _segundos = _date.getSeconds() < 10 ? `0${_date.getSeconds()}` : _date.getSeconds();
    console.log(`[${_hora}:${_minutos}:${_segundos}] JS - (${path}) ha cambiado`);
  }

  // Funciones
  let watchFunctions = gulp.watch(['./gulp-files/js/functions/**/*.js']);
  watchFunctions.on('change', function (path, stats) {
    functionsJs();
    hora(new Date(), path);
  });
});
