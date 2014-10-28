<?php

class Tb_formController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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
				'actions'=>array('index','lihat','getjsonform','viewrecordform'),
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
		$model=new tb_form;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['tb_form']))
		{
			$model->attributes=$_POST['tb_form'];
			$model->json_form = $_POST['tb_form']['json_form'];
			$model->created_by = $_POST['tb_form']['created_by'];
			$model->id_user = $_POST["tb_form"]["id_user"];
			$model->last_updated_at = $_POST["tb_form"]["last_updated_at"];
			$model->created_at = $_POST["tb_form"]["last_updated_at"];
			if($model->save())
				$this->redirect(array('lihat','id'=>$model->id_form));
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

		if(isset($_POST['tb_form']))
		{
			//$model->attributes=$_POST['tb_form'];
			$model->attributes=$_POST['tb_form'];
			$model->json_form = $_POST['tb_form']['json_form'];
			$model->created_by = $_POST['tb_form']['created_by'];
			$model->id_user = $_POST["tb_form"]["id_user"];
			$model->last_updated_at = $_POST["tb_form"]["last_updated_at"];
			$model->created_at = $_POST["tb_form"]["last_updated_at"];
			if($model->save())
				$this->redirect(array('lihat','id'=>$model->id_form));
		}

		$this->render('ubah',array(
			'model'=>$model,
		));
	}


	public function actionViewrecordform()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Headers: Content-Type');
		$id = $_GET["id"];

		if($id !== null)
		{
			$xx = new CDbCriteria;
			$xx->condition = "record_form_id=:id";
			$xx->params = array(":id"=>$id);
			$model = record::model()->findAll($xx);
			$jadi_json['view']= array();


			foreach($model as $row)
			{
				$json_converter = json_decode($row->record_json_data);
				// print_r($json_converter->form_values_data[0].);
				// die();
				$aa = new CDbCriteria;
				$aa->condition = "foto_record_id=:id_record";
				$aa->params = array(":id_record"=>$row->id);
				$render_foto = recordfoto::model()->findAll($aa);
				$jika["foto"] = array();
				foreach ($render_foto as $key) {
					 $anda["img"] = $key->foto;

				
					array_push($jika["foto"], $anda);
					// echo $key->foto;
				}

				

				$json_foto = $jika["foto"];


		
				
				//$json_foto = json_encode($json_foto);
				

				// print_r($jika["foto"]);
						$saya["id"]= $row->id;
						$saya["record_user_id"] = $row->record_user_id	;
						$saya["record_json_data"] = $json_converter->form_values_data[0];
						$saya["foto"] = $json_foto;
						$saya["latitude"] = $row->latitude;
					 	$saya["longitude"] = $row->longitude;
						
						$saya["create_at"] = $row->create_at;
						$saya["last_update"] = $row->last_update;
						
			
				array_push($jadi_json["view"], $saya);
				// array_push($jadi_json["view"], $saya);
				
			}
			
			echo json_encode($jadi_json);
			
		}
		else
		{
			throw new CHttpException(404,'The requested page does not exist.');
		}

	}






	public function actionGetjsonform()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Headers: Content-Type');

		$id = $_GET["id"];
		if($id !== null)
		{
			$xx = new CDbCriteria;
			$xx->condition = "id_user=:id";
			$xx->params = array(":id"=>$id);
			$model = tb_form::model()->findAll($xx);
			$jadi_json['form']= array();

			foreach($model as $row)
			{
				$json_converter = json_decode($row->json_form);
				
				//$saya = array(
					//"form"=>array(
						$saya["user_id"] = $row->id_user;
						$saya["form_id"] = $row->id_form;
						$saya["form_name"] = $row->form_name;
						$saya["form_description"] = $row->form_description;
						$saya["form_json"] = $json_converter->form_json;
						$saya["created_at"] = $row->created_at;
						$saya["created_by"] = $row->created_by;
						$saya["last_updated_at"] = $row->last_updated_at;
				//	)
				//);
				array_push($jadi_json["form"], $saya);
				/*
				print_r($saya["user_id"]);
				die();*/
			}
			

			//$cetak['form'] = $saya;
			/*$str= ltrim ($saya, '['); //remove prefix
			$str= rtrim($str,"]"); //remove sufix*/
			
			echo json_encode($jadi_json);
			
		}
		else
		{
			throw new CHttpException(404,'The requested page does not exist.');
		}
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
		$dataProvider=new CActiveDataProvider('tb_form');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	
	/**
	 * Manages all models.
	 */
	public function actionAtur()
	{	
		 $id_user = Yii::app()->user->getId();

		$model=new tb_form('search_by_id');
		// $model=new tb_form('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['tb_form']))
			$model->attributes=$_GET['tb_form'];

		$this->render('atur',array(
			'model'=>$model,
			"id_user_ak"=>$id_user,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return tb_form the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=tb_form::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param tb_form $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tb-form-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
