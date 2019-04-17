'use strict';

var gulp = require('gulp');
/*
var gulp = require('gulp'),
    watch = require('gulp-watch');
    */
//npm install --save-dev gulp

const includedFileTypes = "js,css,png,jpeg,jpg,svg,tiff,woff,woff2,eot,ttf";
const rootFileTypes = "htaccess";

const sharedAssetsSource = './environments/_shared-assets/**/*';

const $apacheConfig = './environments/_shared-assets/**/.htaccess';

const $frontendSource = './environments/_front_end-assets/**/*.{' + includedFileTypes + '}';
const $backendSource = './environments/_back_end-assets/**/*.{' + includedFileTypes + '}';


const $webFrontendPath = './frontend/myassets/';
const $adminBackendPath = './backend/myassets/';

const $webFrontendRoot = './frontend/';
const $webBackendRoot = './backend/';
const $webApiRoot = './api/';


/*
gulp.task('monitor', function () {
    gulp.watch($frontendSource, ['copy-assets']);
});*/

gulp.task('default', function (done) {
    //--- Copy to front end ---//
    gulp.src(sharedAssetsSource)
        .pipe(gulp.dest($webFrontendPath))
        .pipe(gulp.dest($adminBackendPath));

    gulp.src($frontendSource)
        .pipe(gulp.dest($webFrontendPath));

    gulp.src($backendSource)
        .pipe(gulp.dest($adminBackendPath));

    gulp.src($apacheConfig)
        .pipe(gulp.dest($webFrontendRoot))
        .pipe(gulp.dest($webBackendRoot))
        .pipe(gulp.dest($webApiRoot));

    done();
});

//gulp.task('default', ['copy-assets']);