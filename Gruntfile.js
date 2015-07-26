'use strict';
module.exports = function ( grunt ) {

	// load all grunt tasks matching the `grunt-*` pattern
	// Ref. https://npmjs.org/package/load-grunt-tasks
	require( 'load-grunt-tasks' )( grunt );

	grunt.initConfig( {
		// watch for changes and trigger sass, jshint, uglify and livereload
		watch: {
			sass: {
				files: [ 'sass/**/*.{scss,sass}' ],
				tasks: [ 'sass', 'autoprefixer' ]
			},
			js: {
				files: '<%= uglify.frontend.src %>',
				tasks: [ 'uglify' ]
			},
			livereload: {
				// Here we watch the files the sass task will compile to
				// These files are sent to the live reload server after sass compiles to them
				options: { livereload: true },
				files: [ '*.php', '*.css' ]
			}
		},
		// sass
		sass: {
			dist: {
				options: {
					style: 'expanded'
				},
				files: {
					'style.css': 'sass/style.scss'
				}
			}
		},
		// autoprefixer
		autoprefixer: {
			options: {
				browsers: [ 'last 2 versions', 'ie 9', 'ios 6', 'android 4' ],
				map: true
			},
			files: {
				expand: true,
				flatten: true,
				src: '*.css',
				dest: ''
			}
		},
		// Uglify Ref. https://npmjs.org/package/grunt-contrib-uglify
		uglify: {
			options: {
				banner: '/*! \n * blank_theme v6 JavaScript Library \n * @package blank_theme \n */',
				sourceMap: 'js/main.js.map',
				sourceMappingURL: 'main.js.map',
				sourceMapPrefix: 2
			},
			frontend: {
				src: [
					'js/vendor/jquery.cycle2.js',
					'js/vendor/jquery.sidr.js',
					'js/main.js'
				],
				dest: 'js/main.min.js'
			}
		},
		// Make POT files for translation.
		makepot: {
			target: {
				options: {
					mainFile: 'index.php', // Main project file.
					potFilename: 'languages/blank_theme.pot', // Name of the POT file.
					type: 'wp-theme', // Type of project (wp-plugin or wp-theme).
					updateTimestamp: true // Whether the POT-Creation-Date should be updated without other changes.
				}
			}
		},
		// Add text domain
		addtextdomain: {
			target: {
				files: {
					src: [
						'*.php',
						'**/*.php',
						'!node_modules/**',
						'!tests/**'
					]
				}
			}
		}
	} );
	// register task
	grunt.registerTask( 'default', [ 'sass', 'autoprefixer', 'uglify', 'makepot', 'watch' ] );
};