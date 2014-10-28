<?php

class MakeformController extends Controller
{


	public function actionIndex()
	{
		$model = new tb_form;
		if(isset($_POST["Makeform"]))
		{
			$model->form_name = $_POST["Makeform"];
			if($model->save())
				$this->redirect(array('test'));

		}
		
		$this->render('index',array("model"=>$model));
	}

	public function actionTest()
	{
		$model = new tb_form;
		$this->render("test",array($model));

	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}