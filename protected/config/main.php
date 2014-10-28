<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('editable', dirname(__FILE__).'/../extensions/x-editable');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'modul cms bukapeta',	
	'defaultController' => 'site',
	'theme'=>'temamodul',

	// preloading 'log' component
	'preload'=>array('log','bootstrap'),
	//'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	// loading module user
		'application.modules.user.models.*',
		'application.modules.user.components.*',		
	//loading module rights
		'application.modules.rights.*', 
		'application.modules.rights.components.*',				
	//loading module blog
		'application.modules.blog.models.*', 
		'application.modules.blog.components.*',	
	//loading module aset
		'application.modules.aset.models.*', 
		'application.modules.aset.components.*',
	//loading module kolekin	
		'application.modules.aset.models.*', 
		'application.modules.aset.components.*',				
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'bukapeta',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths' => array(
				'bootstrap.gii'
			),
		),		
				
        'user'=>array(
            # encrypting method (php hash function)
            'hash' => 'sha1',
 
            # send activation email
            'sendActivationMail' => true,
 
            # allow access for non-activated users
            'loginNotActiv' => true,
 
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => true,
 
            # automatically login from registration
            'autoLogin' => false,
			
			# automatically login from registration
            'enableRegistration' => false,
			
            # registration path
            'registrationUrl' => array('/user/registration'), //'/user/registration'
 
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
 
            # login form path
            'loginUrl' => array('/user/login'),
 
            # page after login
            'returnUrl' => array('/'), //'/user/profile'
 
            # page after logout
            'returnLogoutUrl' => array('/'), //'/user/login'
            
            # enable/disable oauth
            'oauth'=>false,
        ),
        'kolekin',
        'rights'=>array(
		    //'debug'=>true,
		    //'superUsers'=>array(
			//	1=>'admin',			
			//),
			'layout'=>'//layouts/column2',
			'superuserName'=>'Admin',
			'userIdColumn'=>'id',    // mengeset nama colom yang menjadi id user
			'userNameColumn'=>'username',  // mengeset nama colom yang menjadi username user
			//'install'=>true,
		    //'enableBizRuleData'=>true,
		 ),			 
		 'blog',
		 		
		 'tps',	 
		 'bukapeta'=>array(
			'defaultController' => 'media', // media sebagai default tanpa extensions
			'extensions' => array(
								//'Data',
								//'Editor',
								//'Peta',
								//'Simbol',
								//'Cerita',
								//'Kolaborasi',
							),			
			/*
			'controllerMap'=>array(
				'data'=>array(
					'class'=>'application.modules.bukapeta.extensions.data.controllers.DataController',
				),
				'editor'=>array(
					'class'=>'application.modules.bukapeta.extensions.editor.controllers.EditorController',
				),
				'peta'=>array(
					'class'=>'application.modules.bukapeta.extensions.peta.controllers.PetaController',
				),
				'simbol'=>array(
						'class'=>'application.modules.bukapeta.extensions.simbol.controllers.SimbolController',
				),
				'cerita'=>array(
					'class'=>'application.modules.bukapeta.extensions.cerita.controllers.CeritaController',
				),
				'kolaborasi'=>array(
					'class'=>'application.modules.bukapeta.extensions.kolaborasi.controllers.KolaborasiController',
				),
			),
			*/ 
		 ),
			
	),						

	// application components
	'components'=>array(	
		'file'=>array(
        'class'=>'application.extensions.file.CFile',
		),
		'editable' => array(
			'class'     => 'editable.EditableConfig',
			'form'      => 'bootstrap',        //form style: 'bootstrap', 'jqueryui', 'plain' 
			'mode'      => 'popup',            //mode: 'popup' or 'inline'  
			'defaults'  => array(              //default settings for all editable elements
			   'emptytext' => 'Click to edit'
							)
		), 
	    'user'=>array(
            // enable cookie-based authentication
            'class' => 'RWebUser',
            'allowAutoLogin'=>true,
            'loginUrl' => array('/user/login'),            
        ),        
		'authManager'=>array(			
			'class'=>'RDbAuthManager',	
			'defaultRoles'=>array('Guest'),
			'itemTable'=>'{{rights_authitem}}',
			'itemChildTable'=>'{{rights_authitemchild}}',
			'assignmentTable'=>'{{rights_authassignment}}',
			'rightsTable'=>'{{rights_rights}}',	
			
		),					
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				//'<action>'=>'site/<action>',				
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',				
				//'<username:\w+>'=>'shop',
				
			),
			//'showScriptName'=>false,
			//'caseSensitive'=>false, 
		),		
		'db' => require(dirname(__FILE__) . '/database.php'),
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
		'JQTree' => array(
			'class' => 'ext.JQTree.JQTree',
		),
		'collapsibletree' => array(
			'class' => 'ext.collapsibletree.CollapsibleTree',
		),
		'bootstrap' => array(
			'class' => 'ext.bootstrap.components.Bootstrap',
			'responsiveCss' => true,
		),
		'IntroJs' => array(
			'class' => 'ext.introjs.IntroJs',
		),
		'highcharts' => array(
			'class' => 'ext.highcharts.HighchartsWidget',
		),
		'amilna'=>array(
			'class'=>'ext.amilna.components.Amilna',
			'uangSimbol' => 'Rp', // Component untuk menentukan reposisi level			
		),		
	),	
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'info@bukapeta.com',
		'webDeveloper'=>'Buka Media Teknologi',		
		'indexFileUrl'=>'index.php', //index.php
		'siteDescription'=>'',
		'metaKeywords'=>'',
		'metaDescription'=>'',
	),
);
