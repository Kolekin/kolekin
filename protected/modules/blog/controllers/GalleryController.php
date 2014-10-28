<?php

class GalleryController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights',
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','lihat'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('buat','ubah'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('atur','hapus'),
								'users'=>array('*'),
				'expression' => 'Yii::app()->user->isSuperUser',
							),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionLihat($id)
	{
		$this->render('lihat',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionBuat()
	{
		$model=new BlogGallery;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BlogGallery']))
		{
			$model->attributes=$_POST['BlogGallery'];
			if($model->save())
				$this->redirect(array('lihat','id'=>$model->id));
		}

		$this->render('buat',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUbah($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BlogGallery']))
		{
			$model->attributes=$_POST['BlogGallery'];
			if($model->save())
				$this->redirect(array('lihat','id'=>$model->id));
		}

		$this->render('ubah',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionHapus($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('atur'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$condition = 'status=1';							
		$criteria=new CDbCriteria(array(
				'condition'=>$condition,
				'order'=>'id DESC',				
			));
		
		$dataProvider=new CActiveDataProvider('BlogGallery',array(
				'pagination'=>array(
					'pageSize'=>12,
				),
				//'pagination'=>false,
				'criteria'=>$criteria
			)	
		);
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAtur()
	{
		$model=new BlogGallery('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['BlogGallery']))
			$model->attributes=$_GET['BlogGallery'];

		$this->render('atur',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BlogGallery the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BlogGallery::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BlogGallery $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='blog-gallery-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
