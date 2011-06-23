<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Hukumonline English',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	// application components
	'components'=>array(
		'user'=>array(
			'class'=>'application.extensions.hole.CHoleWebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'cache'=>array(
		            'class'=>'system.caching.CApcCache'
		            ),
		/*'pageCache'=>array(
		            'class'=>'system.caching.CApcCache'
		            ),*/
		
		'session-ORI'=>array(
		            'class' => 'CDbHttpSession',
					//'class' => 'CCacheHttpSession',
		            'connectionID' => 'identityDb',
		            //'sessionTableName' => 'KutuSession',
					'autoCreateSessionTable' => false, //set this to false when the table has been created.
		        ),

		'session'=>array(
		            'class' => 'application.extensions.hole.CHoleDbHttpSession',
					//'class' => 'CCacheHttpSession',
		            'connectionID' => 'holeIdentityDb',
		            //'sessionTableName' => 'KutuSession',
					'autoCreateSessionTable' => false, //set this to false when the table has been created.
		        ),
		'holeIdentityDb'=>array(
			'class'=>'CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=pengembangan_ina',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'schemaCachingDuration' => 7200,
			//'charset' => 'utf8',
		),
		
		/*
		'db'=>array(
			'connectionString' => 'sqlite:protected/data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			//'connectionString' => 'mysql:host=localhost;dbname=holemptest',
			'connectionString' => 'mysql:host=173.203.97.211;dbname=newhol',
			'emulatePrepare' => true,
			//'username' => 'root',
			//'password' => 'root',
			'username' => 'himawan',
			'password' => 'putra',
			//'charset' => 'utf8',
		),
		
		'pg'=>array(
			'class'=>'CDbConnection',
			//'connectionString' => 'mysql:host=202.153.129.35;dbname=pengembangan;port=3306;unix_socket=/tmp/mysql.sock',
			'connectionString' => 'mysql:host=localhost;dbname=pengembangan;port=3306',
		 	'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'enableParamLogging' => YII_DEBUG,
			'schemaCachingDuration' => 54000 // 15 minutes
		),
		
		//identityDb will also be used as Session DB
		'identityDb'=>array(
			'class'=>'CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=holemptest',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'schemaCachingDuration' => 7200,
			//'charset' => 'utf8',
		),
		'identity'=>array(
			'class'=>'application.extensions.langit.identity.RIIdentity',
			//'loginUrl'=>'',
			//'logoutUrl'=>'',
		),
		
		//MONGODB MANAGER
		'mongoDb'=>array(
			'class'=>'application.extensions.mp.db.MPMongoDbManager',
			'dbName'=>'test',
			'writeServerConnectionString'=>'localhost:27017',
			'readServersConnectionString'=>array('localhost:27017')
		),
	
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'urlManager'=>array(
		            'urlFormat'=>'path',
					'showScriptName' => false,
					'rules'=>array(
					                
					                //'pages/*'=>'hole/default/list',
									'pages/tag/<guid>/*'=>'hole/default/list',
									'info/<id>/*'=>'hole/default/static',
									'pages/<guid>/*'=>'hole/default/details',
					                'CourseCertification'=>'course/certification',
									''=>'hole/default',
					        ),
		),
	),

	// application-level parameters that can be accessed using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com'
	),
	
	//THEME
	'theme'=>'lgsonline',
	
	//MODULE ENVIRONMENT
	'modules'=>array(
		'dms','admin'=>array('theme'=>'admin'),
		'hole'=>array(
				'theme'=>'hole'
			)
	),
);
