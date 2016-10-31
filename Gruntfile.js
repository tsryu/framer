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
        jshintrc: 'js/.jshintrc'
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
          // 'assets/slick-carousel/slick/slick.js',
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
        tasks: 'build',
        options: { livereload: true }
      },
      js: {
        files: '<%= jshint.core.src %>',
        tasks: 'build'
      },
      deploy: {
        options: { spawn: false },
        files: ['dist/*'],
        tasks: 'ftp-deploy:build'
      }
    },

    'ftp-deploy': {
      build: {
        auth: {
          host: 'framer.dothome.co.kr',
          port: 21,
          authKey: 'key1'
        },
        src: './dist',
        dest: '/html/wp-content/themes/framer/dist',
        // exclusions: ['path/to/source/folder/**/.DS_Store', 'path/to/source/folder/**/Thumbs.db', 'path/to/dist/tmp']
      }
    }

  });

  grunt.event.on('watch', function(action, filepath, target) {
      if(target!=='deploy') return;
      grunt.config('ftp-deploy.build.src', filepath);
      grunt.task.run('ftp-deploy');
   });

  // Register tasks
  grunt.registerTask('test-js',   ['jshint', 'concat']);
  grunt.registerTask('dist-js',   ['test-js', 'uglify']);
  grunt.registerTask('test-css',  ['less']);
  grunt.registerTask('dist-css',  ['test-css', 'autoprefixer', 'csscomb', 'csslint', 'cssmin']);

  // Register tasks: devlopment
  grunt.registerTask('js',        ['test-js', 'ftp-deploy']);
  grunt.registerTask('css',       ['test-css', 'ftp-deploy']);
  grunt.registerTask('dev',       ['test-js', 'test-css']);
  grunt.registerTask('default',   ['dev']);

  // Register tasks: production
  grunt.registerTask('build-js',  ['dist-js', 'modernizr']);
  grunt.registerTask('build-css', ['dist-css']);
  grunt.registerTask('build',     ['clean', 'dist-js', 'dist-css', 'modernizr', 'ftp-deploy']);
};