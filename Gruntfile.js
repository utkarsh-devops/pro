module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {   
            dist: {
                src: [
                    'wp-content/themes/vinny/js/jquery.cycle2.min.js',
                    'wp-content/themes/vinny/js/jquery.cycle2.carousel.min.js',
                    'wp-content/themes/vinny/js/jquery.cycle2.swipe.min.js',
                    'wp-content/themes/vinny/js/browserBlast.min.js',
                    'wp-content/themes/vinny/js/modernizr-2.6.2.min.js',
                    'wp-content/themes/vinny/js/jquery.rwdImageMaps.min.js',
                    'wp-content/themes/vinny/js/jquery.qtip.min.js',
                    'wp-content/themes/vinny/js/full-screen-image.js',
                    'wp-content/themes/vinny/js/full-screen-image-inner.js',
                    'wp-content/themes/vinny/js/foundation-full-screen-image-inner.js',
                    'wp-content/themes/vinny/js/jquery.fancybox.pack.js',
                    'wp-content/themes/vinny/js/jquery.mCustomScrollbar.concat.min.js',
                    'wp-content/themes/vinny/js/custom.js',
                    'js/*.js'
                ],
                dest: 'wp-content/themes/vinny/js/production.js',
                nonull: true
            }
        },

        uglify: {
            options: {
              banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
                '<%= grunt.template.today("2014-03-14") %> */'
            },
            build: {
                src: 'wp-content/themes/vinny/js/production.js',
                dest: 'wp-content/themes/vinny/js/production.min.js'
            }
        },

        cssmin: {
          add_banner: {
            options: {
              banner: '/* My minified css file */'
            },
            files: {
              'wp-content/themes/vinny/css/production.min.css': [
                'wp-content/themes/vinny/css/jquery.fancybox.css',
                'wp-content/themes/vinny/css/jquery.mCustomScrollbar.css',
                'wp-content/themes/vinny/css/jquery.qtip.min.css',
                'wp-content/themes/vinny/css/custom.css',
                'css/*.css',
                '!wp-content/themes/vinny/css/production.min.css'
              ]
            }
          }
        },

        watch: {
            scripts: {
                files: ['wp-content/themes/vinny/js/*.js', 'js/libs/*.js'],
                tasks: ['concat', 'uglify']
            },
            css: {
                files: ['wp-content/themes/vinny/css/*.css'],
                tasks: ['cssmin']
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    grunt.registerTask('default', ['concat','uglify','cssmin','watch']);
};