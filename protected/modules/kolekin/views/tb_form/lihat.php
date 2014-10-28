<?php
/* @var $this Tb_formController */
/* @var $model tb_form */

$this->breadcrumbs=array(
	'Tb Form'=>array('index'),
	$model->id_form,
);

$this->menu=array(
	array('label'=>'Indeks Tb Form', 'url'=>array('index')),
	array('label'=>'Buat Tb Form', 'url'=>array('buat')),
	array('label'=>'Ubah Tb Form', 'url'=>array('ubah', 'id'=>$model->id_form)),
	array('label'=>'Hapus Tb Form', 'url'=>'#', 'linkOptions'=>array('submit'=>array('hapus','id'=>$model->id_form),'confirm'=>'Anda yakin akan menghapus data ini?')),
	array('label'=>'Atur Tb Form', 'url'=>array('atur')),
);

$this->pageTitle = '<h1>Lihat Tb Form #'.$model->id_form.'</h1>';
?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_form',
		'form_name',
		'id_user',
		'json_form',
		'created_at',
		'last_updated_at',
		'form_description',
		'created_by',
	),
)); ?>
