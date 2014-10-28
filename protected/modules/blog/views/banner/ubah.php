<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs=array(
	'Banner'=>array('index'),
	$model->id=>array('lihat','id'=>$model->id),
	'Ubah',
);

$this->menu=array(
	array('label'=>'Indeks Banner', 'url'=>array('index')),
	array('label'=>'Buat Banner', 'url'=>array('buat')),
	array('label'=>'Lihat Banner', 'url'=>array('lihat', 'id'=>$model->id)),
	array('label'=>'Atur Banner', 'url'=>array('atur')),
);

$this->pageTitle = '<h1>Ubah Banner '.$model->id.'</h1>';
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
