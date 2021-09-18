module.exports = function (grunt) {
  const path = require('path');
  const cwd = grunt.option('base') || path.dirname(path.resolve('Gruntfile.js'));
  const spawnSync = function(/*cmd, [args...]*/) {
    if (arguments.length < 1) {
      throw "spawnSync expects at least one argument: the command to spawn";
    }

    const cmd = arguments[0];
    const args = Array.prototype.slice.call(arguments, 1);
    const result = require('child_process').spawnSync(cmd, args, { encoded: 'utf-8' });
    if (result.status === 0) {
      grunt.verbose.ok();
    } else {
      grunt.verbose.error();
      if (grunt.option('verbose')) {
        console.log(result);
      }
      grunt.fail.fatal((result.stderr || result.error).toString());
    }
  };

  grunt.initConfig({
    pkg:    grunt.file.readJSON('package.json'),
    concat: {
      "app-css": {
        src: [
          'web/css/opensans.css',
          'web/css/bootstrap-3.0.3.min.css',
          'web/css/font-awesome.all.css',
          'web/css/main.css'
        ],
        dest: 'web/css/app.css'
      },
      "app-js": {
        src: [
          'web/js/jquery-1.11.1.min.js',
          'web/js/bootstrap-3.0.3.min.js',
          'web/js/jquery.scrollTo.js',
          'web/js/jquery.nav.js',
          'web/js/jquery.sticky.js',
          'web/js/jquery.vegas.min.js',
          'web/js/waypoints.min.js',
          'web/js/main.js'
        ],
        dest: 'web/js/app.js'
      },
      "legacy-js": {
        js: {
          src: [
            'web/js/html5shiv.js',
            'web/js/respond.min.js'
          ],
          dest: 'web/js/legacy.js'
        }
      }
    },
    cssmin: {
      css: {
        src:  'web/css/app.css',
        dest: 'web/css/app.min.css'
      }
    },
    uglify: {
      "app-js": {
        files: {
          'web/js/app.min.js': ['web/js/app.js']
        }
      },
      "legacy-js": {
        files: {
          'web/js/legacy.min.js': ['web/js/legacy.js']
        }
      }
    },
    watch: {
      js: {
        files:   ['web/js/*'],
        tasks:   ['minify-js'],
        options: {
          debounceDelay: 5000
        }
      },
      css: {
        files:   ['web/css/*'],
        tasks:   ['minify-css'],
        options: {
          debounceDelay: 1000
        }
      },
      content: {
        files:   ['views/*', 'data.xml'],
        tasks:   ['cache'],
        options: {
          debounceDelay: 1000
        }
      }
    }
  });

  grunt.registerTask('install-deps', function() {
    grunt.log.write('Installing Composer dependencies... ');
    spawnSync('composer', 'install', '-o');
  });

  grunt.registerTask('build-cache', function() {
    grunt.log.write('Building cache... ');
    spawnSync('php', cwd+'/build-cache.php');
  });

  grunt.registerTask('clear-cache', function() {
    grunt.log.write('Clearing cache... ');
    spawnSync('sh', '-c', `rm -r ${cwd}/cache/dev || true`);
  });

  grunt.registerTask('dev-server', function() {
    grunt.log.write('Running development php server at http://127.0.0.1:3000 ...');
    spawnSync('php', '-S', '127.0.0.1:3000', '-t', cwd+'/web');
  });

  grunt.registerTask('minify-js', [
    'concat:app-js',
    'concat:legacy-js',
    'uglify:app-js',
    'uglify:legacy-js'
  ]);

  grunt.registerTask('minify-css', [
    'concat:app-css',
    'cssmin'
  ]);

  grunt.registerTask('minify', ['minify-js', 'minify-css']);

  grunt.registerTask('cache', ['clear-cache', 'build-cache']);
  grunt.registerTask('install', ['install-deps', 'cache']);
  grunt.registerTask('server', ['install', 'dev-server']);

  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-cssmin');

  grunt.registerTask('default', 'minify');
};
