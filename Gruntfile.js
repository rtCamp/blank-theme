module.exports = function( grunt ) {

	// Load all grunt tasks matching the `grunt-*` pattern
	// Ref. https://npmjs.org/package/load-grunt-tasks
	require( 'load-grunt-tasks' )( grunt );

	grunt.initConfig( {
		// Watch for changes and trigger sass, jshint, uglify and livereload
		watch: {
			sass: {
				files: [ 'sass/**/*.{scss,sass}', 'pro/**/*.{scss,sass}' ],
				tasks: [ 'sass', 'autoprefixer', 'cmq' ]
			},
			// Js: {
			// 	files: '<%= uglify.frontend.src %>',
			// 	tasks: [ 'uglify' ]
			// },
			livereload: {
				// Here we watch the files the sass task will compile to
				// These files are sent to the live reload server after sass compiles to them
				options: { livereload: true },
				files: [ '*.php', '*.css', '*.js' ]
			}
		},
		// Compile Sass to CSS
		// Ref. https://www.npmjs.com/package/grunt-contrib-sass
		sass: {
			expanded: {
						options: {
							style: 'expanded', // Nested / compact / compressed / expanded
							sourcemap: 'auto' // Auto / file / inline / none
						},
						files: {
							'style-expanded.css': 'sass/style.scss' // 'destination': 'source'
						}
					  },
			minify: {
						options: {
							style: 'nested', // Nested / compact / compressed / expanded
							sourcemap: 'auto' // Auto / file / inline / none
						},
						files: {
							'style.css': 'sass/style.scss' // 'destination': 'source'
						}
					}
			// Editor: {
			// 			options: {
			// 				style: 'compressed', // nested / compact / compressed / expanded
			// 				sourcemap: 'auto' // auto / file / inline / none
			// 			},
			// 			files: {
			// 				'editor-style.css': 'sass/editor-style.scss' // 'destination': 'source'
			// 			}
			// 		},

		},
		// Autoprefixer
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
			frontend: {
				src: [
					'js/vendor/navigation.js',
					'js/vendor/slick.js',
					'js/vendor/jquery.mmenu.min.all.js',
					'js/main.js'
				],
				dest: 'js/main.min.js'
			}
		},
		// Internationalize WordPress themes and plugins
		// Ref. https://www.npmjs.com/package/grunt-wp-i18n
		//
		// IMPORTANT: `php` and `php-cli` should be installed in your system to run this task
		//
		// IMPORTANT: GNU Gettext should be install to enable `updatePoFiles` task. This will update .po file while running `grunt makepot`
		// Ref. https://www.gnu.org/software/gettext/
		makepot: {
			target: {
				options: {
					cwd: '.',														// Directory of files to internationalize.
					domainPath: 'languages/',										// Where to save the POT file.
					exclude: [ 'node_modules/*', 'dev-lib/*' ],									// List of files or directories to ignore.
					mainFile: 'style.css',											// Main project file.
					potFilename: 'blank-theme.pot',									// Name of the POT file.
					potComments: '',												// The copyright at the beginning of the POT file.
					potHeaders: {													// Headers to add to the generated POT file.
						poedit: true,												// Includes common Poedit headers.
						'Last-Translator': 'Company <support@blank-theme.com>',
						'Language-Team': 'Team <support@blank-theme.com>',
						'report-msgid-bugs-to': 'http://community.rtcamp.com/c/premium-themes',
						'x-poedit-keywordslist': true								// Include a list of all possible gettext functions.
					},
					type: 'wp-theme',												// Type of project (wp-plugin or wp-theme).
					updateTimestamp: true,											// Whether the POT-Creation-Date should be updated without other changes.
					updatePoFiles: false											// Whether to update PO files in the same directory as the POT file.
				}
			}
		},

		addtextdomain: {
			options: {
				//I18nToolsPath: '', // Path to the i18n tools directory.
				textdomain: 'blank-theme', // Project text domain.
				updateDomains: [ 'buddypress', 'textdomain' ]  // List of text domains to replace.
			},
			target: {
				files: {
					src: [
						'*.php',
						'**/*.php',
						'!node_modules/**',
						'!dev-lib/*'
					]
				}
			}
		},

		//https://www.npmjs.com/package/grunt-checktextdomain
		checktextdomain: {
			options: {
				text_domain: 'blank-theme', //Specify allowed domain(s)
				keywords: [ //List keyword specifications
					'__:1,2d',
					'_e:1,2d',
					'_x:1,2c,3d',
					'esc_html__:1,2d',
					'esc_html_e:1,2d',
					'esc_html_x:1,2c,3d',
					'esc_attr__:1,2d',
					'esc_attr_e:1,2d',
					'esc_attr_x:1,2c,3d',
					'_ex:1,2c,3d',
					'_n:1,2,4d',
					'_nx:1,2,4c,5d',
					'_n_noop:1,2,3d',
					'_nx_noop:1,2,3c,4d'
				]
			},
			target: {
				files: [ {
						src: [
							'*.php',
							'**/*.php',
							'!node_modules/**',
							'!dev-lib/*'
						], //All php
						expand: true
					} ]
			}
		},

		// Combine Media Queries
		//
		// Combine matching media queries into one media query definition. Useful for CSS generated by preprocessors using nested media queries.
		// Ref. https://www.npmjs.com/package/grunt-combine-media-queries
		cmq: {
			options: {
				log: false
			},
			target: {
				files: {
					'style.css': ['style.css']
				}
			}
		}
	} );

	// Register task
	grunt.registerTask( 'default', [ 'sass', 'autoprefixer', 'checktextdomain', 'makepot', 'watch' ] );
};
