/**
 * @author: Nguyen Nhu Tuan <tuanquynh0508@gmail.com>
 * @since: 0.0.1
 * @home: http://i-designer.net
 */
module.exports = function (grunt) {

	//Registry plugin
	//Clear all file and folder
	grunt.loadNpmTasks('grunt-contrib-clean');
	//PHP Code Sniffer
	grunt.loadNpmTasks('grunt-phpcs');
	//Start a PHP-server
	grunt.loadNpmTasks('grunt-php');
	//Running phplint on your php files
	grunt.loadNpmTasks('grunt-phplint');
	//phpunit
	grunt.loadNpmTasks('grunt-phpunit');
	//Running PHP Mess Detector
	grunt.loadNpmTasks('grunt-phpmd');
	//Execute
	grunt.loadNpmTasks('grunt-exec');

	//Registry Task
	//Default pre commit
	grunt.registerTask('precommit', ['clean', 'phplint:all', 'phpmd', 'phpunit', 'exec:phpdoc']);

  grunt.registerTask('tuanquynh', ['phplint:all', 'phpcs', 'phpunit:unit']);

	// Project configuration.
	grunt.initConfig({
		////////////////////////////////////////////////////////////////////////
		//Variables-------------------------------------------------------------
		pkg: grunt.file.readJSON('package.json'),
		//Task------------------------------------------------------------------
		clean: {
      build: ["build/"]
    },
    phpcs: {
      application: {
        dir: ['src']
      },
      options: {
        bin: 'bin/phpcs',
        tabWidth: 2,
        reportFile: 'build/phpcs.txt'
      }
    },
    phplint: {
      options: {
        swapPath: '/tmp'
      },
      all: ['src/**/*.php']
    },
    phpunit: {
      classes: {
        dir: ''
      },
      options: {
        bin: 'bin/phpunit',
        configuration: 'app/phpunit.xml.dist',
        colors: true,
        coverageHtml: 'build/coverage',
        testdoxText: 'build/testdox.txt',
        followOutput: true,
        execMaxBuffer: 1024*1024
      }
    },
    phpmd: {
      application: {
        dir: 'src'
      },
      options: {
        bin: 'bin/phpmd',
        reportFormat: 'text',
        rulesets: 'codesize,unusedcode,design'
      }
    },
    exec: {
      phpdoc: {
        command: 'php app/console api:doc:dump --format=html > build/tuanquynh-api-doc.html'
      },
      reload_statistics_database: {
        command: function(env) {
          if(typeof(env) === 'undefined') {
            env = 'dev';
          }
          var cmd = 'php app/console doctrine:database:drop --force --env=ENV_NAME --connection=default && ' +
                    'php app/console doctrine:database:create --env=ENV_NAME --connection=default && ' +
                    'php app/console doctrine:schema:create --env=ENV_NAME --em=default && ' +
                    'php app/console doctrine:fixtures:load --append --env=ENV_NAME --fixtures=src/TuanQuynh/RestBundle/DataFixtures/ORM --em=default';
          return cmd.replace(/ENV_NAME/g, env);
        }
      },
      reload_test_statistics_database: {
        command:'php app/console doctrine:database:drop --force --env=test --connection=default && ' +
                'php app/console doctrine:database:create --env=test --connection=default && ' +
                'php app/console doctrine:schema:create --env=test --em=default && ' +
                'php app/console doctrine:fixtures:load --append --env=test --fixtures=src/TuanQuynh/RestBundle/DataFixtures/Tests --em=default'
      }
    }
		////////////////////////////////////////////////////////////////////////
	}); //End grunt.initConfig

};