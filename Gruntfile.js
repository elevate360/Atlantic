/* jshint node:true */
module.exports = function (grunt) {

	'use strict';

	// Project configuration.
	grunt.initConfig({

		pkg: grunt.file.readJSON( 'package.json' ),

		// Check textdomain errors.
		checktextdomain: {
			options:{
				text_domain: '<%= pkg.name %>',
				keywords: [
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
			files: {
				src:  [
					'**/*.php', // Include all files
					'!node_modules/**',
					'!dist/**',
					'!orig/**'
				],
				expand: true
			}
		},

		makepot: {
			options: {
				type: 'wp-theme',
				domainPath: 'languages',
				potHeaders: {
					'report-msgid-bugs-to': 'https://github.com/elevate360/caspian/issues',
					'language-team': 'LANGUAGE <EMAIL@ADDRESS>'
				}
			},
			frontend: {
				options: {
					potFilename: '<%= pkg.name %>.pot',
					exclude: [
						'node_modules/.*',
						'dist/.*',
						'orig/.*'
					]
				}
			}
		},

		// Compile all .scss files.
		sass: {
			dist: {
				options: {
					require: 'susy',
					sourceMap: false
				},
				files: [{
					'style.css': 'sass/style.scss',
					'assets/css/editor-style.css': 'sass/editor-style.scss',
					'assets/css/woocommerce.css': 'sass/woocommerce.scss'
				}]
			}
		},

		postcss: {
			options: {
				processors: [
					require( 'autoprefixer' )({
						browsers: [
							'> 1%',
							'last 2 versions',
							'Firefox ESR',
							'Opera 12.1',
							'ie 9'
						]
					})
				]
			},
			main: {
				src: 'style.css',
				dest: 'style.css'
			},
			editor: {
				src: 'assets/css/editor-style.css',
				dest: 'assets/css/editor-style.css'
			},
			woocommerce: {
				src: 'assets/css/woocommerce.css',
				dest: 'assets/css/woocommerce.css'
			}
		},

	    wpcss: {
	        style: {
	            options: {
	                commentSpacing: true
	            },
	            files: {
	            	'style.css': ['style.css'],
	            	'assets/css/editor-style.css': ['assets/css/editor-style.css'],
	            	'assets/css/woocommerce.css': ['assets/css/woocommerce.css']
	            }
	        }
	    },

		cssmin: {
			target: {
				files: [{
					expand: true,
					cwd: './',
					src: ['assets/css/*.css', '!assets/css/*.min.css'],
					dest: './',
					ext: '.min.css'
				}]
			}
		},

		// JavaScript linting with JSHint.
		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			all: [
				'Gruntfile.js',
				'assets/js/*.js',
				'!assets/js/*.min.js'
			]
		},

		uglify: {
			options: {
				preserveComments: 'some'
			},
			theme: {
				files: [{
					expand: true,
					cwd: 'assets/js/',
					src: [
						'*.js',
						'!*.min.js'
					],
					dest: 'assets/js/',
					ext: '.min.js'
				}]
			}
		},

		watch: {
			css: {
				files: [
					'sass/style.scss',
					'sass/editor-style.scss',
					'sass/woocommerce.scss',
					'sass/elements/*.scss',
					'sass/forms/*.scss',
					'sass/layout/*.scss',
					'sass/layout/*-*.scss',
					'sass/media/*.scss',
					'sass/mixins/*.scss',
					'sass/modules/*.scss',
					'sass/navigation/*.scss',
					'sass/navigation/*-*.scss',
					'sass/site/*.scss',
					'sass/site/**/*.scss',
					'sass/typography/*.scss',
					'sass/variables-site/*.scss'
				],
				tasks: [
					'sass'
				]
			},
			js: {
				files: [
					'assets/js/<%= pkg.name %>.js',
					'assets/js/customizer.js'
				],
				tasks: [
					'uglify'
				]
			}
		},

		browserSync: {
		    dev: {
		        bsFiles: {
		            src: ['style.css', 'assets/**/**', '**/*.php']
		        },
		        options: {
		        	watchTask: true,
		            proxy: 'localhost/elevate/<%= pkg.name %>'
		        }
		    }
		},

		// Replace text
		replace: {
			themeVersion: {
				src: [
					'sass/style.scss'
				],
				overwrite: true,
				replacements: [ {
					from: /^.*Version:.*$/m,
					to: 'Version: <%= pkg.version %>'
				} ]
			}
		},

		// Clean up dist directory
		clean: {
			main: ['dist']
		},

		// Copy the theme into the dist directory
		copy: {
			main: {
				src:  [
					'**',
					'!csscomb.json',
					'!node_modules/**',
					'!.sass-cache/**',
					'!sass/**',
					'!dist/**',
					'!orig/**',
					'!.git/**',
					'!Gruntfile.js',
					'!package.json',
					'!.gitignore',
					'!.gitmodules',
					'!**/Gruntfile.js',
					'!**/package.json',
					'!**/*~'
				],
				dest: 'dist/<%= pkg.name %>/'
			}
		},

		// Compress build directory into <name>.<version>.zip
		compress: {
			main: {
				options: {
					mode: 'zip',
					archive: './dist/<%= pkg.name %>.<%= pkg.version %>.zip'
				},
				expand: true,
				cwd: 'dist/<%= pkg.name %>/',
				src: ['**/*'],
				dest: '<%= pkg.name %>/'
			}
		}

	});

	grunt.loadNpmTasks( 'grunt-postcss' );
	grunt.loadNpmTasks( 'grunt-browser-sync' );
    grunt.loadNpmTasks( 'grunt-checktextdomain' );
    grunt.loadNpmTasks( 'grunt-contrib-clean' );
    grunt.loadNpmTasks( 'grunt-contrib-compress' );
    grunt.loadNpmTasks( 'grunt-contrib-copy' );
    grunt.loadNpmTasks( 'grunt-contrib-cssmin' );
    grunt.loadNpmTasks( 'grunt-contrib-jshint' );
    grunt.loadNpmTasks( 'grunt-contrib-watch' );
    grunt.loadNpmTasks( 'grunt-sass' );
    grunt.loadNpmTasks( 'grunt-text-replace' );
    grunt.loadNpmTasks( 'grunt-contrib-uglify' );
    grunt.loadNpmTasks( 'grunt-wp-css' );
    grunt.loadNpmTasks( 'grunt-wp-i18n' );

	grunt.registerTask( 'default', [
		'browserSync',
		'watch'
	]);

	grunt.registerTask( 'css', [
		'sass',
		'postcss',
		'wpcss',
		'cssmin'
	]);

	grunt.registerTask( 'dist', [
		'replace',
		'css',
		'uglify',
		'clean',
		'copy',
		'compress'
	]);

};
