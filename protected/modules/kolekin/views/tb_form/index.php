<?php
/* @var $this Tb_formController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tb Form',
);

$this->menu=array(
	array('label'=>'Buat Tb Form', 'url'=>array('buat')),
	array('label'=>'Atur Tb Form', 'url'=>array('atur')),
);

$this->pageTitle = '<h1>Tb Form</h1>';
?>


<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
