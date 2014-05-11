module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		sass: {
			build: {
				files: {
					'css/custom.css': 'sass/custom.sass'
				},
				options: {
					style: 'compressed'
				}
			}
		},
		autoprefixer: {
			options: {
				browsers: ['last 10 versions', 'ie 8', 'ff 12']
			},
			build: {
				expand: true,
				flatten: true,
				src: 'css/global.css',
				dest: ''
			}
		},
		cssmin: {
			minify: {
				expand: true,
				src: ['global.css', '!global.min.css'],
				dest: '',
				ext: '.min.css'
			},
			combine: {
				files: {
					'css/global.css': ['css/*.css']
				}
			}
		},
		uglify: {
			global: {
				files: {
					'global.min.js': ['js/*.js']
				}
			}
		},
		remove: {
			oldjs: {
				options: {
					trace: true
				},
				fileList: ['js/global.min.js']
			},
			oldcss: {
				options: {
					trace: true
				},
				fileList: ['global.css', 'global.min.css', 'css/global.css', 'css/custom.css']
			}
		},
		watch: {
			sass_watch: {
				files: ['sass/*.sass'],
				tasks: ['css_build']
			},
			js_watch: {
				files: ['js/*.js'],
				tasks: ['js_build']
			},
			css_watch: {
				files: ['css/*.css'],
				options: {
					livereload: false,
				},
			},
		},
	});

	grunt.registerTask('default', ['watch']);
	grunt.registerTask('css_build', ['remove:oldcss', 'sass:build', 'cssmin:combine', 'autoprefixer:build', 'cssmin:minify']);
	grunt.registerTask('js_build', ['remove:oldjs', 'uglify:global']);
	require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);
};
