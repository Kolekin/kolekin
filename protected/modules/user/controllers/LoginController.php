<?php

class LoginController extends Controller
{
	public $defaultAction = 'login';
	public $layout = '//layouts/column1';
	/**
	 * Displays the login page
	 */
	 
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', 
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('oauthadmin','halamanlogin'),
				'users'=>UserModule::getAdmins(),
			),
			array('deny',  // deny all users
				'actions'=>array('oauthadmin'),
				'users'=>array('*'),
			),
		);
	}
	 
	public function actions()
	{
		
		$lf = array();
		
		if ($this->module->oauth)
		{
			$lo = array(		
				'oauth' => array(
					// the list of additional properties of this action is below
					'class'=>'ext.hoauth.HOAuthAction',
					// Yii alias for your user's model, or simply class name, when it already on yii's import path
					// default value of this property is: User
					'model' => 'User', 
					// map model attributes to attributes of user's social profile
					// model attribute => profile attribute
					// the list of avaible attributes is below
					'attributes' => array(
					  'email' => 'email',
					  /*
					  'fname' => 'firstName',
					  'lname' => 'lastName',
					  'gender' => 'genderShort',
					  'birthday' => 'birthDate',
					  */ 
					  // you can also specify additional values, 
					  // that will be applied to your model (eg. account activation status)
					  'status' => 1,				  
					),				
				  ),
				  // this is an admin action that will help you to configure HybridAuth 
				  // (you must delete this action, when you'll be ready with configuration, or 
				  // specify rules for admin role. User shouldn't have access to this action!)
				  'oauthadmin' => array(
					'class'=>'ext.hoauth.HOAuthAdminAction',
				  ),
			);
			$lf = array_merge($lf,$lo);
		}
		
		return $lf;
	}


	public function actionHalamanlogin()
	{
		$this->render('halamanlogin');
	}
	
	public function actionLogin($o = true)
	{
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();
					if (Yii::app()->user->returnUrl == Yii::app()->baseUrl.'/index.php')
						$this->redirect(Yii::app()->controller->module->returnUrl);
						 
					else
						$this->redirect(Yii::app()->user->returnUrl);
				}
			}
			// display the login form
						
			if (!$this->module->oauth)
			{
				$o = false;	
			}			
			
			$lf = array('model'=>$model,'o'=>$o);
			
			$this->render('/user/login',$lf);
		} else
			$this->redirect(Yii::app()->controller->module->returnUrl);
	}
	
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}

}
