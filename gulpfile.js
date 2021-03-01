const { src, dest, series, watch } = require('gulp')
const sass = require('gulp-dart-sass')
const concat = require('gulp-concat')

const scss = () => src('src/scss/style.scss')
	.pipe(sass().on('error', sass.logError))
	.pipe(dest('dist/'))

const js = () => src([
	'./node_modules/jquery/dist/jquery.js',
	'./node_modules/simplebar/dist/simplebar.js',
	'./src/js/*.js',
])
	.pipe(concat('main.js'))
	.pipe(dest('dist/'))

const copySrc = () => src([
	'./src/functions.php/**/*',
	'./src/backend/**/*',
	'./src/fractals/**/*',
	'./src/include/**/*',
	'./src/partials/**/*',
	'./src/functions.php'
], { base: './src' }).pipe(dest('dist'))

const copyTemplates = () => src([
	'./src/templates/**/*'
]).pipe(dest('dist'))

const copyStatic = () => src([
	'./assets/**/*',
	'./vendor/**/*'
], { base: '.' }).pipe(dest('dist'))

/** Watch for changes */

// const watcher = watch(['src/*'])
// watcher.on('change')

const doWatch = () => {
	watch('src/scss/*.scss', series(scss, copyStatic))
	watch('src/js/*.js', series(js, copyStatic))
	watch('src/templates', copyTemplates)
}

/** Exports */

exports.watch = doWatch
exports.build = series(scss, js)
exports.copy = series(copySrc, copyTemplates, copyStatic)
exports.default = series(scss, js, copySrc, copyTemplates, copyStatic)
