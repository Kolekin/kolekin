<?php
/* @var $this Tb_formController */
/* @var $model tb_form */

$this->breadcrumbs=array(
	'Tb Form'=>array('index'),
	'Buat',
);

$this->menu=array(
	array('label'=>'Indeks Tb Form', 'url'=>array('index')),
	array('label'=>'Atur Tb Form', 'url'=>array('atur')),
);

$this->pageTitle = '<h1>Buat Tb Form</h1>';
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>