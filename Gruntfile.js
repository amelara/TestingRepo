module.exports = function (grunt) {
	//Project configuration
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		uglify: {
			options: {
				banner: '/*! <%= pkg.name %> | <%= grunt.template.today("dd-mm-yyyy") %> | Strivtech - Developer: Franco Salas */\n'
			},
			build: {
				src: 'public/js/custom.js',
				dest: 'public/js/custom.min.js'
			}
		}
	});

	// Load the plugin that provides the "uglify" task.
	grunt.loadNpmTasks('grunt-contrib-uglify');

	// Default task(s).
	grunt.registerTask('default', ['uglify']);
}