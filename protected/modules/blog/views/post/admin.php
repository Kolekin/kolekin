<?php
$this->breadcrumbs=array(
	'Atur Postingan',
);

$menu=array(
	array('label'=>'Blog', 'url'=>array('/blog/post')),		
);

if (Yii::app()->user->isSuperuser)
{
$this->menu=array_merge($menu,array(
	array('label'=>'Buat Postingan', 'url'=>array('/blog/post/create')),	
	array('label'=>'Atur Postingan', 'url'=>array('/blog/post/admin')),
	array('label'=>'Atur Komentar', 'url'=>array('/blog/comment')),
));
}

$this->pageTitle = '<h1>Atur Postingan</h1>';
?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'title',
			'type'=>'raw',
			'value'=>'CHtml::link(CHtml::encode($data->title), $data->url)'
		),
		array(
			'name'=>'status',
			'value'=>'Lookup::item("PostStatus",$data->status)',
			'filter'=>Lookup::items('PostStatus'),
		),
		array(
			'name'=>'create_time',
			'type'=>'datetime',
			'filter'=>false,
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
