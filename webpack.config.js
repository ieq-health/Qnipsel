'use strict'

const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {

	entry: ['./src/js/main.js', './src/scss/main.scss'],

	output: {
		path: path.resolve(__dirname, 'dist/'),
	},

	module: {
		rules: [

			/**
			 * JS
			 * Bundle
			 */
			{
				test: /\.js$/,
				exclude: /(node_modules|bower_components)/,
			},

			/**
			 * CSS
			 * Compile SCSS from /src/scss/main.scss to /dist/css/index.css
			 */
			{
				test: /\.scss$/,
				use: [ MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader' ]
			},
		]
	},

	plugins: [
		new MiniCssExtractPlugin({
			filename: 'main.css',
			allChunks: true,
		}),
	]

};