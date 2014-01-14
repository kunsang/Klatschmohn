module.exports = function(grunt) {
  grunt.initConfig({
	pkg: grunt.file.readJSON('package.json'),
	sass: {
	  build: {
		files: {
		  'css/custom.css': 'sass/custom.sass'
		},
		options: {
		  sourcemap: true,
		  style: 'expanded'
		}
	  }
	},
	autoprefixer: {
	  options: {
		// note the addition of this option over original grunt-autoprefixer
		sourcemap: true,
		browsers: ['last 2 version', 'ie 8', 'ie 9', 'ff 18']
	  },
	  build: {
		files: {
		  'css/custom.css' : 'css/custom.css'
		},
	  },
	},
	watch: {
	  sass_watch: {
		files: ['sass/*.sass'],
		tasks: ['css_build']
	  },
	  css_watch: {
		files: ['css/*.css'],
		options: {
		  livereload: false,
		},
	  },
	},
  });

  grunt.registerTask('default', ['watch'] );
  grunt.registerTask('css_build',  ['sass:build', 'autoprefixer:build']);
  require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);
};
