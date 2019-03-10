'use strict';

var gulp = require('gulp');
/*
var gulp = require('gulp'),
    watch = require('gulp-watch');
    */
//npm install --save-dev gulp

const includedFileTypes = "js,css,png,jpeg,jpg,svg,tiff,woff,woff2,eot,ttf";

const sharedAssetsSource = './environments/_shared-assets/**/*';
const $frontendSource = './environments/_front_end-assets/**/*.{' + includedFileTypes + '}';
const $backendSource = './environments/_back_end-assets/**/*.{' + includedFileTypes + '}';

const $webFrontendPath = './frontend/myassets/';
const $adminBackendPath = './backend/myassets/';


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

    done();
});

//gulp.task('default', ['copy-assets']);