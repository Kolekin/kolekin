<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	
	public $mapConfig;
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'		
		$this->render('index');
		//$this->actionBeranda();
	}
	
	public function actionTes()
	{
		$this->render('tes');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->redirect(Yii::app()->createUrl('/user/login'));
		/*
		$this->layout = '//layouts/dashboard/login';
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('application.modules.user.views.user.login',array('model'=>$model));
		*/
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	
	public function actionInstall()
	{
		Yii::app()->amilna->installSqls();	
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionBeranda(){
		Yii::app()->theme = 'imh';
		$this->layout = '//layouts/home/beranda';
		$oleh = 'Bukapeta';
		$judul = 'Cerita di Bukapeta';
		
		Yii::app()->amilna->ambilUrlAset('modules.bukapeta.peta.data.assets');
		Yii::app()->amilna->ambilUrlAset('modules.bukapeta.extensions.data.assets');
		Yii::app()->amilna->ambilUrlAset('modules.bukapeta.extensions.peta.assets');
		Yii::app()->amilna->ambilUrlAset('modules.bukapeta.extensions.cerita.assets');
		$asetModul =  Yii::app()->amilna->ambilUrlAset('modules.bukapeta.assets');			
		$configPeta = Yii::app()->getModule('bukapeta')->Media->ambilConfigPeta($oleh,$judul); //method dari komponen lihat
		$configPeta->asetModul = $asetModul;
						
		$PetaCfg= '{
						"extent":[94,-11,141,8],
						"data":[
									{	"nama":"Cerita_di_Bukapeta",
										"link":"#",
										"label":"Cerita di Bukapeta",
										"terlihat":true,
										"tipe":"geojson",
										"epsg":"EPSG:4326",
										"url":"http://'.$_SERVER['SERVER_NAME'].Yii::app()->createUrl('/bukapeta').'/cerita/ambilLokasi",
										"rule":[
													{	"name":"Cerita di Bukapeta",
														"symbolizer": symbol.Default
													}
												]
									}
								]
					}';		
		
		$this->render('beranda/index',array(		
			'oleh'=>$oleh,
			'judul'=>$judul,
			'asetModul'=>$asetModul,
			'configPeta'=>$configPeta,
			'PetaCfg'=>$PetaCfg,
		));		
	}

	public function actionDashboard(){
		$this->layout = '//layouts/dashboard/dashboard';
		$this->render('dashboard');
	}
}
