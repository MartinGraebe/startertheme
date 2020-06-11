const { src, dest, task, watch, series, parallel } = require('gulp');


// css plugins
var sass    = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');


// js plugins

var uglify  = require('gulp-uglify');
var babelify = require('babelify');
var browserify = require('browserify');
var source = require('vinyl-source-stream');
var buffer = require('vinyl-buffer');
var stripDebug = require('gulp-strip-debug');

// utility

var rename = require('gulp-rename');
var sourcemaps = require('gulp-sourcemaps');
var notify = require('gulp-notify');
var plumber = require('gulp-plumber');
var options = require('gulp-options');
var gulpif = require('gulp-if');






// Variables
var styleSRC     = './src/scss/style.scss';
var editorStyleSRC     = './src/scss/style-editor.scss';
var styleURL     = './';
var mapURL       = './';

var jsSRC        = './src/js/';
var jsFront      = 'main.js';
var jsFiles      = [ jsFront ];
var jsURL        = './dist/js/';

var imgSRC       = './src/images/**/*';
var imgURL       = './dist/images/';

var fontsSRC     = './src/fonts/**/*';
var fontsURL     = './dist/fonts/';




var styleWatch   = './src/scss/**/*.scss';
var jsWatch      = './src/js/**/*.js';
var imgWatch     = './src/images/**/*.*';
var fontsWatch   = './src/fonts/**/*.*';

// tasks

function css(done) {
    src( [ styleSRC ] )
        .pipe( sourcemaps.init() )
        .pipe( sass({
            errLogToConsole: true,
            outputStyle: 'compressed'
        }) )
        .on( 'error', console.error.bind( console ) )
        .pipe( autoprefixer() )

        .pipe( sourcemaps.write( mapURL ) )
        .pipe( dest( styleURL ) )
    ;
    done();
};
function editorcss(done) {
    src( [ editorStyleSRC ] )
        .pipe( sourcemaps.init() )
        .pipe( sass({
            errLogToConsole: true,
            outputStyle: 'compressed'
        }) )
        .on( 'error', console.error.bind( console ) )
        .pipe( autoprefixer() )

        .pipe( sourcemaps.write( mapURL ) )
        .pipe( dest( styleURL ) )
    ;
    done();
};

function js(done) {
    jsFiles.map( function( entry ) {
        return browserify({
            entries: [jsSRC + entry]
        })
            .transform( babelify, { presets: [ '@babel/preset-env' ] }, { plugins: ["@babel/transform-runtime"]} )
            .bundle()
            .pipe( source( entry ) )
            .pipe( rename( {
                extname: '.min.js'
            } ) )
            .pipe( buffer() )
            .pipe( gulpif( options.has( 'production' ), stripDebug() ) )
            .pipe( sourcemaps.init({ loadMaps: true }) )
            .pipe( uglify() )
            .pipe( sourcemaps.write( '.' ) )
            .pipe( dest( jsURL ) )
            ;
    });
    done();
};

function triggerPlumber( src_file, dest_file ) {
    return src( src_file )
        .pipe( plumber() )
        .pipe( dest( dest_file ) );
}

function images() {
    return triggerPlumber( imgSRC, imgURL );
};

function fonts() {
    return triggerPlumber( fontsSRC, fontsURL );
};


function watch_files() {
    watch(styleWatch, css);
    watch(jsWatch, js);
    watch(imgWatch, images);
    watch(fontsWatch, fonts);

    src(jsURL + 'main.min.js')
        .pipe( notify({ message: 'Gulp is Watching, Happy Coding!' }) );
}

task("css", css);
task("editor css", editorcss);
task("js", js);
task("images", images);
task("fonts", fonts);

task("default", parallel(css, editorcss, js, images, fonts));
task("watch", watch_files);