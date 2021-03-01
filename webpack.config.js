'use strict'

const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyPlugin = require('copy-webpack-plugin');

module.exports = env => {
	return {

		entry: ['./src/js/main.js', './src/scss/main.scss'],

		output: {
			path: path.resolve(__dirname, 'dist/'),
		},

		plugins: [
			/**
			 * CSS
			 * Compile SCSS from /src/scss/main.scss to /dist/style.css
			 */
			new MiniCssExtractPlugin({
				filename: 'style.css',
			}),

			/**
			 * Copy PHP files
			 */
			new CopyPlugin({
				patterns: [
					{ from: "vendor", to: "vendor" },
					{ from: "src/backend", to: "backend" },
					{ from: "src/fractals", to: "fractals" },
					{ from: "src/include", to: "include" },
					{ from: "src/partials", to: "partials" },
					{ from: "src/templates", to: "" }
				]
			})
		],

		module: {
			rules: [{
				test: /\.scss$/,
				use: [ MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader' ]
			}]
		},


		resolve: {
			alias: {
				jquery: 'jquery/src/jquery'
			}
		}

	}
};
