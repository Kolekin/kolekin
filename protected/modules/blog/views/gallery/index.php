<?php
/* @var $this GalleryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Galleries',
);

$this->menu=array(
	array('label'=>'Buat Blog Gallery', 'url'=>array('buat')),
	array('label'=>'Atur Blog Gallery', 'url'=>array('atur')),
);

$this->pageTitle = '<h1>Galleries</h1>';
?>


<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'htmlOptions'=>array('class'=>'portfolio thumbnails'),
)); ?>

<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/js/lightbox/css/lightbox.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/lightbox/js/lightbox.js',CClientScript::POS_END);
?>
