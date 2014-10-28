<?php
$this->breadcrumbs=array(
	'Blog'=>array('//blog/post'),
	'Atur Komentar',
);
?>

<?php
$menu=array(
	array('label'=>'Blog', 'url'=>array('//blog/post')),	
);

if (Yii::app()->user->isSuperuser)
{
$this->menu=array_merge($menu,array(
	array('label'=>'Buat Postingan', 'url'=>array('/blog/post/create')),	
	array('label'=>'Atur Postingan', 'url'=>array('/blog/post/admin')),
	array('label'=>'Atur Komentar', 'url'=>array('/blog/comment')),
));
}

$this->pageTitle = '<h1>Atur Komentar</h1>';
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'htmlOptions'=>array('style'=>'padding-top:0px;margin-top:0px;','class'=>'blog-comments-container'),
)); ?>
