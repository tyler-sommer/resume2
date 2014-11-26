module.exports = function (grunt) {
  grunt.initConfig({
    pkg:    grunt.file.readJSON('package.json'),
    concat: {
      css: {
        src:  [
          'web/css/magnific-popup.css',
          'web/css/main.css'
        ],
        dest: 'web/css/app.css'
      },
      js:  {
        src:  [
          'web/js/jquery.scrollTo.js',
          'web/js/jquery.nav.js',
          'web/js/jquery.sticky.js',
          'web/js/jquery.vegas.min.js',
          'web/js/jquery.isotope.min.js',
          'web/js/jquery.magnific-popup.min.js',
          'web/js/waypoints.min.js',
          'web/js/main.js'
        ],
        dest: 'web/js/app.js'
      }
    },
    cssmin: {
      css: {
        src:  'web/css/app.css',
        dest: 'web/css/app.min.css'
      }
    },
    uglify: {
      js: {
        files: {
          'web/js/app.min.js': ['web/js/app.js']
        }
      }
    },
    watch:  {
      files:   ['web/css/*', 'web/js/*'],
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
