<?php
/* @var $this Tb_formController */
/* @var $model tb_form */

$this->breadcrumbs=array(
	'Tb Form'=>array('index'),
	$model->id_form=>array('lihat','id'=>$model->id_form),
	'Ubah',
);

$this->menu=array(
	array('label'=>'Indeks Tb Form', 'url'=>array('index')),
	array('label'=>'Buat Tb Form', 'url'=>array('buat')),
	array('label'=>'Lihat Tb Form', 'url'=>array('lihat', 'id'=>$model->id_form)),
	array('label'=>'Atur Tb Form', 'url'=>array('atur')),
);

$this->pageTitle = '<h1>Ubah Tb Form '.$model->id_form.'</h1>';
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>