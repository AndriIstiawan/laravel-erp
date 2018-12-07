var gulp = require('gulp'), file = require('gulp-file');

gulp.task('default', ['copycss','copyfonts','custom', 'copyjs','copyjsapp','copyimg']);

/*
* CSS files
*/
gulp.task('copycss', function() {
	return gulp.src([
		'node_modules/font-awesome/css/*',
		'node_modules/simple-line-icons/css/simple-line-icons.css',
		'resources/assets/Static_Full_Project_GULP/src/css/*'
	]).pipe(gulp.dest("public/css"))
});	

gulp.task('custom', function() {
  var str = "";
  return gulp.src('scripts/**.js')
    .pipe(file('custom.css', str))
    .pipe(gulp.dest('public/css'));
});

/* 
FONTS 
*/
gulp.task('copyfonts', function() {
	return gulp.src([
		'node_modules/font-awesome/fonts/*',
		'node_modules/simple-line-icons/fonts/*'	
		]).pipe(gulp.dest('public/fonts'));
});

/*
* Copy JS files
*/
gulp.task('copyjs', function() {
	return gulp.src([
		'node_modules/jquery/dist/jq*',
		'node_modules/popper.js/dist/umd/po*.js',
		'node_modules/bootstrap/dist/js/boo*.js',
		'node_modules/pace/dist/js/boo*.js',
		'node_modules/pace-progress/pac*.js',
		'node_modules/chart.js/dist/Ch*.js',
		'resources/assets/Static_Full_Project_GULP/src/js/**'
		]).pipe(gulp.dest('public/js/vendor'));
});

gulp.task('copyjsapp', function() {
	return gulp.src([
		'resources/assets/Static_Full_Project_GULP/src/js/**'
		]).pipe(gulp.dest('public/js'));
});

/*
* Copy Images
*/
gulp.task('copyimg', function() {
	return gulp.src(['resources/assets/Static_Full_Project_GULP/src/img/**'])
		.pipe(gulp.dest('public/img'));
})