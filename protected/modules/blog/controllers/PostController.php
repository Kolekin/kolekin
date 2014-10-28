<?php

class PostController extends RController
{
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	public $kategori;
	public $title;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(			
			'rights',
			//'accessControl', // perform access control for CRUD operations			
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
			array('allow',  // allow all users to access 'index' and 'view' actions.
				'actions'=>array('index','view','diff'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to access all actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the register page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
        );
    }

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{		
		$post=$this->loadModel();
		$comment=$this->newComment($post);

		$this->render('view',array(
			'model'=>$post,
			'comment'=>$comment,
		));
	}


	/**
	 * Displays a particular model.
	 */
	public function actionDiff($id1,$id2,$way = '')
	{						
		Yii::import('gii.components.TextDiff');				
				
		$m1 = Post::model()->findByPk($id1);
		$m2 = Post::model()->findByPk($id2);
		
		$lines1 = $m1->content;
		$lines2 = $m2->content;
		
		if (!($way == 'Context' || $way == 'Unified'  || $way == 'Natural'))		
		{
			$compare = 'compare';	
		}	
		else
		{
			$compare = 'compare'.$way;	
		}
		//$diff=TextDiff::compare($lines1, $lines2);				
		//$diff=TextDiff::compareContext($lines1, $lines2);		
		$diff=TextDiff::$compare($lines1, $lines2);		

		$this->renderPartial('system.gii.views.common.diff',array(		
			'diff'=>$diff,
		));		
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Post;
		if(isset($_POST['Post']))
		{						
			
			$model->attributes=$_POST['Post'];
			
			$uploadedFile=CUploadedFile::getInstance($model,'gambar');
			if(!empty($uploadedFile))  // check if uploaded file is set or not
			{
				$rnd = rand(0,9999);  // generate random number between 0-9999            				
				$fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
				$model->gambar = $fileName;
			}						
			
			if($model->save())
			{
				if(!empty($uploadedFile))  // check if uploaded file is set or not
				{
					$uploadedFile->saveAs($this->module->getBasePath().'/assets/img/'.$model->gambar);  				
				}	
				$this->redirect(array('view','id'=>$model->id));
			}	
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
		if(isset($_POST['Post']))
		{
												
			//$_POST['Post']['gambar'] = $model->gambar; 						
			$model->attributes=$_POST['Post'];
			
			$uploadedFile=CUploadedFile::getInstance($model,'gambar');
			//$uploadedFile=CUploadedFile::getInstanceByName('gambar');
			//print_r($_POST['Post']);
			//die('<br>'.empty($uploadedFile).' : '.$uploadedFile);
			
			if(!empty($uploadedFile))  // check if uploaded file is set or not
			{
				//die('tes');
				$rnd = rand(0,9999);  // generate random number between 0-9999            				
				$fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
				$model->gambar = $fileName;
			}
			
			if($model->save())
			{
				if(!empty($uploadedFile))  // check if uploaded file is set or not
                {
                    $uploadedFile->saveAs($this->module->getBasePath().'/assets/img/'.$model->gambar);  
                }
				$this->redirect(array('view','id'=>$model->id));
			}	
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria=new CDbCriteria(array(
			'condition'=>'status='.Post::STATUS_PUBLISHED,
			'order'=>'update_time DESC',
			'with'=>'commentCount',
		));
		if(isset($_GET['tag']))
			$criteria->addSearchCondition('tags',$_GET['tag']);					

		$dataProvider=new CActiveDataProvider('Post', array(
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['postsPerPage'],
			),
			'criteria'=>$criteria,
		));				

		$this->render('index',array(
			'dataProvider'=>$dataProvider			
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Post('search');
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];
			
		$model->dbCriteria->order='"t"."id" DESC';		
			
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Suggests tags based on the current user input.
	 * This is called via AJAX when the user is entering the tags input.
	 */
	public function actionSuggestTags()
	{
		if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
		{
			$tags=Tag::model()->suggestTags($keyword);
			if($tags!==array())
				echo implode("\n",$tags);
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				if(Yii::app()->user->isGuest)
					$condition='status='.Post::STATUS_PUBLISHED.' OR status='.Post::STATUS_ARCHIVED;
				else
					$condition='';
				$this->_model=Post::model()->findByPk($_GET['id'], $condition);
			}
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Creates a new comment.
	 * This method attempts to create a new comment based on the user input.
	 * If the comment is successfully created, the browser will be redirected
	 * to show the created comment.
	 * @param Post the post that the new comment belongs to
	 * @return Comment the comment instance
	 */
	protected function newComment($post)
	{
		$comment=new Comment;
		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($comment);
			Yii::app()->end();
		}
		if(isset($_POST['Comment']))
		{
			$comment->attributes=$_POST['Comment'];
			if($post->addComment($comment))
			{
				if($comment->status==Comment::STATUS_PENDING)
					Yii::app()->user->setFlash('commentSubmitted','Thank you for your comment. Your comment will be posted once it is approved.');
				$this->refresh();
			}
		}
		return $comment;
	}
}
