module.exports = function (grunt) {
  'use strict';
  
  // These plugins provide necessary tasks.
  require('load-grunt-tasks')(grunt, { scope: 'devDependencies' });
  require('time-grunt')(grunt);
  grunt.loadNpmTasks('grunt-ftp-deploy');

  grunt.initConfig({

    // Metadata.
    pkg: grunt.file.readJSON('package.json'),

    // Task configuration.
    clean: {
      dist: [
        '<%= less.core.dest %>',
        '<%= less.core.options.sourceMapFilename %>',
        '<%= cssmin.core.dest %>',
        '<%= concat.core.dest %>',
        '<%= uglify.core.dest %>',
      ]
    },

    jshint: {
      options: {
        jshintrc: 'js/.jshintrc',
        reporterOutput:"",
      },
      grunt: {
        options: {
          jshintrc: '.jshintrc'
        },
        src: 'Gruntfile.js'
      },
      core: {
        src: 'js/project.js'
      }
    },

    concat: {
      core: {
        src: [
          // 'bower_components/angular/angular.js',
          // 'bower_components/angular-sanitize/angular-sanitize.js',
          // 'js/app.js',
          'js/prism.js',
          '<%= jshint.core.src %>'
        ],
        dest: 'dist/js/script.js'
      }
    },

    uglify: {
      core: {
        src: '<%= concat.core.dest %>',
        dest: 'dist/js/script.min.js'
      }
    },

    less: {
      core: {
        options: {
          strictMath: true,
          sourceMap: true,
          sourceMapURL: 'style.css.map',
          sourceMapFilename: 'dist/css/style.css.map',
          sourceMapRootpath: '..',
        },
        src: 'less/style.less',
        dest: 'dist/css/style.css'
      }
    },

    autoprefixer: {
      options: {
        browsers: [
          'Android 2.3',
          'Android >= 4',
          'Chrome >= 20',
          'Firefox >= 24',
          'Explorer >= 8',
          'iOS >= 6',
          'Opera >= 12',
          'Safari >= 6'
        ]
      },
      core: {
        options: {
          map: true
        },
        src: '<%= less.core.dest %>'
      },
    },

    csscomb: {
      options: {
        config: 'less/.csscomb.json'
      },
      dist: {
        expand: true,
        cwd: 'css/',
        src: ['*.css', '!*.min.css'],
        dest: 'dist/css/'
      },
    },

    csslint: {
      options: {
        csslintrc: 'less/.csslintrc'
      },
      dist: '<%= less.core.dest %>'
    },

    cssmin: {
      options: {
        compatibility: 'ie8',
        keepSpecialComments: '*',
        noAdvanced: true
      },
      core: {
        src: '<%= less.core.dest %>',
        dest: 'dist/css/style.min.css'
      }
    },

    modernizr: {
      dist: {
        "devFile" : "js/modernizr.min.js",
        "outputFile" : "dist/js/modernizr.min.js",
        "extra" : {
          "shiv" : false,
        },
        "files" : {
          "src": ['js/project.js', 'dist/css/style.min.css']
        }
      }
    },
     
    watch: {
      less: {
        files: ['less/**/*.less'],
        tasks: 'css',
        options: { livereload: true }
      },
      js: {
        files: '<%= jshint.core.src %>',
        tasks: 'js'
      },
      deploy: {
        options: { spawn: false },
        files: ['dist/*'],
        tasks: 'rsync:dev'
      }
    },
    
    rsync: {
      options: {
        args: ['-zvr'],
        exclude: ['.git*', '.*', '*.less', '*.php', 'assets', 'images', 'node_modules'],
        recursive: true
      },
      dev: {
        options: {
          src: 'dist/*',
          dest: '/home/hosting_users/framerkr/www/wp-content/themes/framer',
          host: 'framerkr@framerjs.co.kr',
          delete: false
        }
      },
      deploy: {
        options: {
          src: 'dist/*',
          dest: '/home/hosting_users/framerkr/www/wp-content/themes/framer',
          host: 'framerkr@framerjs.co.kr',
          delete: false
        }
      }
    }

  });

  // grunt.event.on('watch', function(action, filepath, target) {
  //     if(target!=='deploy') return;
  //     grunt.config('rsync.deploy.options.src', filepath);
  //     grunt.task.run('rsync:deploy');
  //  });

  // Register tasks
  grunt.registerTask('test-js',   ['jshint', 'concat']);
  grunt.registerTask('dist-js',   ['test-js', 'uglify']);
  grunt.registerTask('test-css',  ['less']);
  grunt.registerTask('dist-css',  ['test-css', 'autoprefixer', 'csscomb', 'csslint', 'cssmin']);

  // Register tasks: devlopment
  grunt.registerTask('js',        ['dist-js', 'rsync:dev']);
  grunt.registerTask('css',       ['dist-css', 'rsync:dev']);
  grunt.registerTask('dev',       ['dist-js', 'dist-css']);
  grunt.registerTask('default',   ['dev']);

  // Resister tasks: production
  grunt.registerTask('build-js',  ['dist-js', 'modernizr']);
  grunt.registerTask('build-css', ['dist-css']);
  grunt.registerTask('build',     ['clean', 'dist-js', 'dist-css', 'modernizr', 'rsync:deploy']);

};