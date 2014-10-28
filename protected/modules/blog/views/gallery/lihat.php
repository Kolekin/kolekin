<?php
/* @var $this GalleryController */
/* @var $model BlogGallery */

$this->breadcrumbs=array(
	'Blog Galleries'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Indeks Blog Gallery', 'url'=>array('index')),
	array('label'=>'Buat Blog Gallery', 'url'=>array('buat')),
	array('label'=>'Ubah Blog Gallery', 'url'=>array('ubah', 'id'=>$model->id)),
	array('label'=>'Hapus Blog Gallery', 'url'=>'#', 'linkOptions'=>array('submit'=>array('hapus','id'=>$model->id),'confirm'=>'Anda yakin akan menghapus data ini?')),
	array('label'=>'Atur Blog Gallery', 'url'=>array('atur')),
);

$this->pageTitle = '<h1>Lihat Blog Gallery #'.$model->id.'</h1>';
?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'url',
		'keterangan',
		'status',
		'tags',
		'tipe',
	),
)); ?>

<div class="span10"><img src="<?php echo $model->url;?>" alt="<?php echo $model->keterangan;?>" title="<?php echo $model->keterangan;?>" class="img-polaroid"></div>
