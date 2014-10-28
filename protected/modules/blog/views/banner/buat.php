<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs=array(
	'Banner'=>array('index'),
	'Buat',
);

$this->menu=array(
	array('label'=>'Indeks Banner', 'url'=>array('index')),
	array('label'=>'Atur Banner', 'url'=>array('atur')),
);

$this->pageTitle = '<h1>Buat Banner</h1>';
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
