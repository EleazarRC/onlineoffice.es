// https://gulpjs.com/plugins
const { src, dest, watch, parallel } = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const plumber = require("gulp-plumber");
const autoprefixer = require('autoprefixer');
const cssnano = require("cssnano");
const postcss = require("gulp-postcss");
const cache = require("gulp-cache");
const imagemin = require("gulp-imagemin");
const webp = require("gulp-webp");
const avif = require("gulp-avif");
const sourcemaps = require("gulp-sourcemaps");
const notify = require('gulp-notify');
const concat = require('gulp-concat');
const terser = require("gulp-terser-js");
const rename = require('gulp-rename');

// Ubicaciones
const paths = {
  scss: 'src/scss/**/*.scss',
  js: 'src/js/**/*.js',
  imagenes: 'src/img/**/*.{png,jpg}',
  html: './*.html'
}


function css(done) {
  src(paths.scss) // Identificar el archivo .SCSS a compilar
    .pipe(sourcemaps.init()) //
    .pipe(plumber())
    .pipe(sass()) // Compilarlo
    .pipe( postcss([ autoprefixer(), cssnano()])) // Mejora de compatibilidad y optimizado
    .pipe(sourcemaps.write('.')) // Para ver en la consola del navegador donde están exactamente las cosas.
    .pipe(dest("./public/build/css")); // Almacenar en el disco duro
  done();
}

function imagenes(done) {
  const opciones = {
    optimizationLevel: 3
  }
  src(paths.imagenes)
    .pipe( cache( imagemin(opciones)))
    .pipe( dest('./public/build/img'))
    //.pipe(notify({ message: 'Imagen Completada'}));
  done();
}

function versionWebp(done) {
  const opciones = {
    quality: 50,
  };
  src(paths.imagenes)
    .pipe(webp(opciones))
    .pipe(dest("./public/build/img"))
    //.pipe(notify({ message: 'Imagen Completada'}));
  done();
}

function versionAvif(done) {
  const opciones = {
    quality: 50,
  };
  src(paths.imagenes)
    .pipe(avif(opciones))
    .pipe(dest("./public/build/img"))
    //.pipe(notify({ message: 'Imagen Completada'}));
  done();
}

function javascript(done) {
  src(paths.js)
    .pipe( sourcemaps.init())
    .pipe(concat('bundle.js')) // final output file name
    .pipe( terser())
    .pipe( sourcemaps.write('.'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(dest("./public/build/js"));
  done();
}

function watchArchivos(done) {
  watch( paths.scss , css);
  watch( paths.js, javascript);
  watch( paths.imagenes, imagenes );
  watch( paths.imagenes, versionAvif );
  watch( paths.imagenes, versionWebp );
  done();
}

exports.css = css;
exports.js = javascript;
exports.imagenes = imagenes;
exports.versionWebp = versionWebp;
exports.versionAvif = versionAvif;
exports.dev = parallel(css, imagenes, versionWebp, versionAvif, javascript, watchArchivos );
