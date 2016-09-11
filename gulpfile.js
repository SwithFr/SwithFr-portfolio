var gulp        = require('gulp');
var sass        = require('gulp-sass');
var uglify      = require('gulp-uglify');

gulp.task('serve', ['sass'], function() {
    gulp.watch("./App/Webroot/sass/**/*.scss", ['sass']);
    gulp.watch("./App/Webroot/js/*.js", ['js']);
});

gulp.task('sass', function() {
    return gulp.src("./App/Webroot/sass/*")
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(gulp.dest("./App/Webroot/css"))
});

gulp.task('js', function() {
    return gulp.src('./App/Webroot/js/*.js')
        .pipe(uglify())
        .pipe(gulp.dest('./App/Webroot/js/min'))
});

gulp.task('default', ['serve']);