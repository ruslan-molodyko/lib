/**
 * Created by ruslan-molodyko on 02.04.2016.
 */
var gulp = require('gulp'),
    browserify = require('browserify'),
    source = require('vinyl-source-stream'),
    rename = require('gulp-rename'),
    glob = require('glob'),
    es = require('event-stream'),
    uglify = require('gulp-uglify'),
    stylus = require('gulp-stylus'),
    CONFIG = {
        pathToDestFolder: __dirname + '/../',
        prefixPath: __dirname + '/src/',
        pathToScript: 'js/**/*.js',
        pathToStylus: 'stylus/**/*.styl'
    };

/**
 * Create browserify bundles
 * http://fettblog.eu/gulp-browserify-multiple-bundles/
 */
gulp.task('scripts', ['copy'], function(done) {

    glob(CONFIG.prefixPath + CONFIG.pathToScript, function(err, files) {
        if(err) done(err);

        var tasks = files.map(function(entry) {
            return browserify({ entries: [entry] })
                .bundle()
                .pipe(source(entry))
                .pipe(rename({
                    extname: '.bundle.js'
                }))
                .pipe(gulp.dest(CONFIG.pathToDestFolder));
        });
        es.merge(tasks).on('end', done);
    })
});


/**
 * Move other resources
 */
gulp.task('copy', function(cb) {
    return gulp.src([
        // Include all
        CONFIG.prefixPath + '**/*',
        // Exclude stylus folder
        '!' + CONFIG.prefixPath + 'stylus{,/**}'
    ])
    .pipe(gulp.dest(CONFIG.pathToDestFolder + 'src'));
});

/**
 * Compile stylus
 */
gulp.task('styles', function() {
    return gulp.src([CONFIG.prefixPath + CONFIG.pathToStylus])
        .pipe(stylus({compress : true}))
        .pipe(rename({
            extname: '.bundle.css'
        }))
        .pipe(gulp.dest(CONFIG.pathToDestFolder + 'src/css'));
});

/**
 * Run actions
 */
gulp.task('default', ['copy', 'scripts', 'styles'], function() {
    gulp.watch(CONFIG.prefixPath + '**/*', ['copy', 'scripts', 'styles']);
});
