module.exports = function (grunt) {
  grunt.initConfig({
    pkg:    grunt.file.readJSON('package.json'),
    concat: {
      css: {
        src:  [
          'css/bootstrap.min.css',
          'css/font-awesome.min.css',
          'css/magnific-popup.css',
          'css/main.css'
        ],
        dest: 'css/app.css'
      },
      js:  {
        src:  [
          'js/jquery-1.10.2.min.js',
          'js/bootstrap.min.js',
          'js/jquery.scrollTo.js',
          'js/jquery.nav.js',
          'js/jquery.sticky.js',
          'js/jquery.easypiechart.min.js',
          'js/jquery.vegas.min.js',
          'js/jquery.isotope.min.js',
          'js/jquery.magnific-popup.min.js',
          'js/waypoints.min.js',
          'js/main.js'
        ],
        dest: 'js/app.js'
      }
    },
    cssmin: {
      css: {
        src:  'css/app.css',
        dest: 'css/app.min.css'
      }
    },
    uglify: {
      js: {
        files: {
          'js/app.min.js': ['js/app.js']
        }
      }
    },
    watch:  {
      files:   ['css/*', 'js/*'],
      tasks:   ['concat', 'cssmin', 'uglify'],
      options: {
        debounceDelay: 1000
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.registerTask('default', ['concat:css', 'cssmin:css', 'concat:js', 'uglify:js']);
};