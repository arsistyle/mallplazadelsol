let gulp = require('gulp');
let sass = require('gulp-sass');
let sourcemaps = require('gulp-sourcemaps');
let concat = require('gulp-concat');
let uglifycss = require('gulp-uglifycss');
let autoprefixer = require('gulp-autoprefixer');
let rename = require('gulp-rename');
let wait = require('gulp-wait');

const gulpCss = (name, path, end) => {
  return gulp.src([
    `./gulp-files/scss/${name}/${name}.scss`
  ])
    .pipe(wait(200))
    .pipe(sourcemaps.init())
    .pipe(sourcemaps.identityMap())
    .pipe(sass({
      outputStyle: 'expanded',
      sourceComments: true
    }).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(rename(`${name}.css`))
    .pipe(
      sourcemaps.mapSources((sourcePath, file) => {
        // source paths are prefixed with '../src/'
        return '../assets/' + sourcePath;
      })
    )
    .pipe(sourcemaps.write('./'))
    .pipe(
      sourcemaps.init({
        loadMaps: true,
        largeFile: true
      })
    )
    .pipe(gulp.dest(path || './assets/css'))
    .on('end', end);
};
const minCss = () => {
  let init = console.log('-->-->---> Se está creando el archivo allcss.min.css ...');
  function msj() {
    return console.log('---------> Se creó el archivo allcss.min.css');
  }
  return gulp.src([
    // './fonts/fln-icons.css',
    './assets/css/ars1.css',
    './assets/css/style.css'
  ])
    .pipe(concat('style.css'))
    .pipe(uglifycss({
      //'uglyComments': true
    }))
    .pipe(gulp.dest('./'))
    // .on('end', msj);
};
const ars1Css = () => gulpCss('ars1', null, minCss);
const styleCss = () => gulpCss('style', null, minCss);

gulp.task('css', () => {

  function hora(date, path) {
    let _date = date;
    let _hora = _date.getHours() < 10 ? `0${_date.getHours()}` : _date.getHours();
    let _minutos = _date.getMinutes() < 10 ? `0${_date.getMinutes()}` : _date.getMinutes();
    let _segundos = _date.getSeconds() < 10 ? `0${_date.getSeconds()}` : _date.getSeconds();
    console.log(`[${_hora}:${_minutos}:${_segundos}] CSS - (${path}) ha cambiado`);
  }

  // ARS1
  let watchARS1 = gulp.watch(['./gulp-files/scss/ars1/**/*.scss']);
  watchARS1.on('change', function (path, stats) {
    ars1Css();
    hora(new Date(), path);
  });

  // style
  let watchstyle = gulp.watch(['./gulp-files/scss/style/**/*.scss']);
  watchstyle.on('change', function (path, stats) {
    styleCss();
    hora(new Date(), path);
  });
});
