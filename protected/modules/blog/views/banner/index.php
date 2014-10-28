<?php
/* @var $this BannerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Banner',
);

$this->menu=array(
	array('label'=>'Buat Banner', 'url'=>array('buat')),
	array('label'=>'Atur Banner', 'url'=>array('atur')),
);

$this->pageTitle = '<h1>Banner</h1>';
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
