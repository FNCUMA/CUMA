const babelify = require('babelify');
const browserify = require('browserify');
const buffer = require('vinyl-buffer');
const concat = require('gulp-concat');
const del = require('del');
const gulp = require('gulp');
const imagemin = require('gulp-imagemin');
const gulpif = require('gulp-if');
const minifyCSS = require('gulp-csso');
const pug = require('gulp-pug');
const sass = require('gulp-sass');
const source = require('vinyl-source-stream');
const sourcemaps = require('gulp-sourcemaps');
const sync = require('browser-sync').create();
const uglify = require('gulp-uglify');
const autoprefixer = require('gulp-autoprefixer');

const isProd = process.env.NODE_ENV === 'production';

/**
* PUG
*/
function templates() {
    return gulp.src('src/pages/*.pug')
        .pipe(pug({
            pretty: true
        }))
        .pipe(gulp.dest('dist/'))
        .pipe(sync.stream());
}

/**
* SCSS
*/
function scss() {
    return gulp.src('src/scss/styles.scss')
        .pipe(gulpif(!isProd, sourcemaps.init()))
        .pipe(sass())
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .on('error', function(err) {
            console.error(err);
            this.emit('end');
        })
        .pipe(gulpif(isProd, minifyCSS()))
        .pipe(gulpif(!isProd, sourcemaps.write('.')))
        .pipe(gulp.dest('dist/css'))
        .pipe(sync.stream());
}

/**
* JS
*/
function js() {
    return browserify({entries: ['src/js/scripts.js'], debug: true})
        .transform(babelify, {presets: 'es2015'})
        .bundle()
        .on('error', function(err) {
            console.error(err);
            this.emit('end');
        })
        .pipe(source('scripts.js'))
        .pipe(buffer())
        .pipe(gulpif(!isProd, sourcemaps.init({loadMaps: true})))
        .pipe(uglify())
        .pipe(gulp.dest('dist/js'))
        .pipe(sync.stream());
}

/**
* IMAGES
*/
function images() {
    return gulp.src('src/assets/img/**/*')
        .pipe(gulpif(isProd, imagemin({verbose: true})))
        .pipe(gulp.dest('dist/assets/img'));
}

/**
* FONTS
*/
function fonts() {
    return gulp.src('src/assets/fonts/*')
        .pipe(gulp.dest('dist/assets/fonts'));
}

/**
* GLOBAL
*/
function clean() {
    return del(['dist']);
}

gulp.task('build', gulp.series(clean, gulp.parallel(templates, scss, js, images, fonts)));

gulp.task('default', gulp.parallel(templates, scss, images, fonts, function(done) {
    sync.init({
        server: {
            baseDir: './dist'
        },
        browser: 'google chrome'
    });

    gulp.watch('src/pages/**/*.pug', templates);
    gulp.watch('src/scss/**/*.scss', scss);
    gulp.watch('src/js/**/*.js', js);
    gulp.watch('src/assets/img/**/*', images);
    gulp.watch('src/assets/fonts/**/*', fonts);

    done();
}))
