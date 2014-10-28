<?php

class DefaultController extends Controller
{
	public $layout='//layouts/column4';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}
