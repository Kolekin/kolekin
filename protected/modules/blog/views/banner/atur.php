<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs=array(
	'Banner'=>array('index'),
	'Atur',
);

$this->menu=array(
	array('label'=>'Indeks Banner', 'url'=>array('index')),
	array('label'=>'Buat Banner', 'url'=>array('buat')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#banner-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

$this->pageTitle = '<h1>Atur Banner</h1>';

?>

<p>
Anda dapat memasukan operator perbandingan (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
atau <b>=</b>) di awal kata pencarian untuk mendapatkan hasil pencarian yang spesifik.
</p>

<?php //echo CHtml::link('Pencarian Lanjutan','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'banner-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',				
		array
		(
			'name'=>'gambar',
			'type'=>'raw',
			'value'=>function($data,$row)
			{
				return '<img src="'.Yii::app()->getBaseUrl().'/aset2/uploads/images/'.$data->gambar.'" class="timg">';
			}
		),			
		'keterangan',
		array(
			'name'=>'status',
			'value'=>'Banner::itemAlias("BannerStatus",$data->status)',
			'filter' => Banner::itemAlias("BannerStatus"),
		),
		//array(
		//	'class'=>'CButtonColumn',
		//),
		array
		(
			'class'=>'CButtonColumn',
			'deleteConfirmation'=>"js:'Record dengan ID '+$(this).parent().parent().children(':first-child').text()+' akan dihapus! Yakin?'",
			'template'=>'{view}{update}{delete}',
			'buttons'=>array
			(
				'view' => array
				(
					'label'=>'Lihat data',
					'url'=>'array("lihat", "id"=>$data->id)'
					//'visible'=>'$data->score > 0',
					//'click'=>'function(){alert("Going down!");}',
				),
				'update' => array
				(
					'label'=>'Ubah data', //'[-]'
					'url'=>'array("ubah", "id"=>$data->id)'
					//'visible'=>'$data->score > 0',
					//'click'=>'function(){alert("Going down!");}',
				),
				'delete' => array
				(
					'label'=>'Hapus data',
					'url'=>'array("hapus", "id"=>$data->id)'
					//'visible'=>'$data->score > 0',
					//'click'=>'function(){alert("Anda akan menghapus!");}',
				),
			),
		),
	),
)); ?>
