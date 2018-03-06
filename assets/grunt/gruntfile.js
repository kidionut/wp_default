module.exports = function(grunt) {
    grunt.initConfig({

        // Sass compiler 
        sass: {
            dist: {
                files: [{
                    expand: true,
                    cwd: '../src/sass',
                    src: ['style.scss'],
                    dest: '../dist/css/',
                    ext: '.css'
                }],

            }
        },

        // Autoprefixer
        autoprefixer: {
            options: {
                map: true,
                browsers: ['> 0.000001%']
            },
            no_dest_single: {
                src: '../dist/css/style.css'
            },
        },

        // CSS minifier
        cssmin: {
            minify: {
                options: {
                    keepSpecialComments: 0
                },
                files: [{

                    // General CSS miniier
                    expand: true,
                    cwd: '../dist/css',
                    src: ['style.css'],
                    dest: '../dist/css/',
                    ext: '.min.css'
                }]
            }
        },

        //CRITICAL CSS
        criticalcss: {
            custom: {
                options: {
                    url: 'http://localhost/',
                    filename: "../dist/css/style.css",
                    outputfile: '../dist/css/critical.css',                      
                    buffer: 800*1024,
                    width: 3000,
                    height: 3000,
                    restoreFontFaces: false,        
                },
            }
        },
        
        // JS Concat
        concat: {
            options: {
                separator: ';',
                expand: true,
                minify: true,
                preserveComments: false,
            },
            dist: {
                src: ['../src/js/plugins/*.js' , '../src/js/scripts/*.js', '../src/js/main.js'],
                dest: '../dist/js/scripts.js',
            },
        },
        uglify: {
            js: {
                src: ['../dist/js/scripts.js'],
                dest: '../dist/js/scripts.min.js'
            },
        },

        // Reload Page when changes are made in php/html files.
        html: {
            files: ['*.php', '*.html'],
            options: {
                livereload: true,
            }
        },

        // Download Fonts to use
        googlefonts: {
            build: {
                options: {
                    fontPath: '../dist/fonts/',
                    cssFile: '../src/sass/03_core/_02_fonts.scss',
                    httpPath: '../fonts/',
                    formats: {
                        woff: true
                    },
                    fonts: [{
                            family: 'Montserrat',
                            styles: [
                                700, 300, 600, 400, 500, 200, 900, 800
                            ],
                        }
                    ],
                }
            }
        },
        // Deletes all .css files.
        clean: {
            options: {
                force: true
            },
            css: ['../dist/css/*.css' , '../dist/css/*.map' , '!../dist/css/admin-style.css']
        },

        // Wacth for scss/js changes and autocompile them
        watch: {
            options: {
                spawn: false // Very important, don't miss this
            },
            css: {
                files: ['../src/sass/*.scss', '../src/sass/**/*.scss', '!../src/sass/plugins/*.scss', '!../src/sass/plugins/**/*.scss'],
                tasks: ['clean' , 'sass'],
                options: {
                    livereload: true,
                }
            },
            js: {
                files: ['../src/js/**/*.js'],
                tasks: ['concat'],
                options: {
                    livereload: true,
                    sourceMap: true,
                    separator: ';',

                }
            },
        },
    });


    grunt.loadNpmTasks('grunt-contrib-watch');      // Watch
    grunt.loadNpmTasks('grunt-contrib-sass');       // SASS
    grunt.loadNpmTasks('grunt-autoprefixer');       // AUTOPREFIXER
    grunt.loadNpmTasks('grunt-contrib-cssmin');     // CSS MIN
    grunt.loadNpmTasks('grunt-criticalcss');           // CRITICAL CSS
    grunt.loadNpmTasks('grunt-contrib-concat');     // JS CONCAT
    grunt.loadNpmTasks('grunt-contrib-uglify');     // JS MIN
    grunt.loadNpmTasks('grunt-google-fonts');       // GOOGLE FONTS
    grunt.loadNpmTasks('grunt-contrib-clean');      // CLEAN

    /* Bs init works only on html static files. Please comment bs-init property if you work on a php project */
    grunt.registerTask('default', [ 'clean' , 'googlefonts' , 'sass', 'autoprefixer', 'cssmin' , 'criticalcss' ,'concat', 'uglify']);
};