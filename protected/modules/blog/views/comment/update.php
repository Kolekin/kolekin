<?php
$this->breadcrumbs=array(
	'Comments'=>array('index'),
	'Update Comment #'.$model->id,
);
?>

<?php
$menu=array(
	array('label'=>'Blog', 'url'=>array('/blog/post')),		
);

if (Yii::app()->user->isSuperuser)
{
$this->menu=array_merge($menu,array(
	array('label'=>'Buat Postingan', 'url'=>array('/blog/post/create')),	
	array('label'=>'Atur Postingan', 'url'=>array('/blog/post/admin')),
	array('label'=>'Atur Komentar', 'url'=>array('/blog/comment')),
));
}

$this->pageTitle = '<h1>Ubah Komentar #'.$model->id.'</h1>';
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
