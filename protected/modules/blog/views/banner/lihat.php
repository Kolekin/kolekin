<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs=array(
	'Banner'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Indeks Banner', 'url'=>array('index')),
	array('label'=>'Buat Banner', 'url'=>array('buat')),
	array('label'=>'Ubah Banner', 'url'=>array('ubah', 'id'=>$model->id)),
	array('label'=>'Hapus Banner', 'url'=>'#', 'linkOptions'=>array('submit'=>array('hapus','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Atur Banner', 'url'=>array('atur')),
);

$this->pageTitle = '<h1>Lihat Banner #'.$model->id.'</h1>';
?>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'gambar',
		'keterangan',
		'status',
	),
)); ?>
