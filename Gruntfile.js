module.exports = function (grunt) {

	require('load-grunt-tasks')(grunt);
	var sassMode = 'main';

	grunt.initConfig({

		watch: {
        	options: {
        	  spawn: false,
        	  livereload: true
        	},
		    js: {
		        files: ['build/js/**/*.js'],
		        tasks: ['jshint', 'concat:mainJS']
		    },
		    css: {
		        files: ['build/scss/**/*.scss'],
		        tasks: ['sass:'+sassMode]
		    },
		    configFiles: {
			    files: ['Gruntfile.js']
			}
		},

		jshint: {
			options: {
				ignores: 'build/js/main.js'
			},
		    all: ['build/js/*.js']
		},

	    uglify: {
			main: {
		        files: {
		            'app/js/main.min.js': ['app/js/main.js']
		        }
		    },
		    full: {
		        files: {
		            'app/js/full.min.js': ['app/js/full.js']
		        }
		    }
        },

        concat: {
	        mainJS : {
		    	src: [
		    		'build/js/*.js',
		    		'build/js/modules/*.js'
		    	],
		    	dest: 'app/js/main.js'
		    },
		    fullJS : {
		    	src: [
		    		'app/js/vendors/concat/*.js',
		    		'app/js/main.min.js'
		    	],
		    	dest: 'app/js/full.js'
		    }
		},

        cssmin: {
		    main: {
		        files: {
		            'app/css/main.min.css': ['app/css/main.prefix.css']
		        }
		    }
        },

        autoprefixer: {
            options: {
              browsers: ['last 2 versions', 'ie 8', 'ie 9']
            },
		    main: [{
		        expand: true,
		        flatten: true,
		        src: 'app/css/main.css',
		        dest: 'app/css/main.prefix.css'
		    }]
          },

		sass: {
		    explode: {
		    	options : {
			        style: 'expanded',
			        sourcemap: 'none',
			        update: true
				},
		        files: [{
	                expand: true,
	                cwd: 'build/scss',
	                src: ['*/*.scss'],
	                dest: 'app/css/explode',
	                ext: '.css',
	                flatten: false
	            }]
		    },
	        main: {
	        	options : {
	    	        style: 'expanded',
	    	        sourcemap: 'none'
	    		},
	            files: {
	                'app/css/main.css': 'build/scss/main.scss'
	            }
	        }
		},

		

	});

	grunt.registerTask('css', ['sass:main', 'autoprefixer', 'cssmin:main']);
	grunt.registerTask('js', ['jshint:all', 'concat:mainJS', 'concat:fullJS', 'uglify:full']);
	grunt.registerTask('default', ['css', 'js']);

}