<?php
/* @var $this Tb_formController */
/* @var $model tb_form */

$this->breadcrumbs=array(
	'Tb Form'=>array('index'),
	'Atur',
);

$this->menu=array(
	array('label'=>'Indeks Tb Form', 'url'=>array('index')),
	array('label'=>'Buat Tb Form', 'url'=>array('buat')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tb-form-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

$this->pageTitle = '<h1>Atur Tb Form</h1>';
?>



<p>
Anda dapat memasukan operator perbandingan (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
atau <b>=</b>) di awal kata pencarian untuk mendapatkan hasil pencarian yang spesifik.
</p>

<?php echo CHtml::link('Pencarian Lanjutan','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'tb-form-grid',
	'dataProvider'=>$model->search_by_id($id_user_ak),
	'responsiveTable' => true,
	'filter'=>$model,
	'columns'=>array(
		'id_form',
		'form_name',
		'id_user',
		//'json_form',
		'created_at',
		
		/*
		'form_description',
		'created_by',
		*/
		
		array
		(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'deleteConfirmation'=>"js:'Record dengan ID '+$(this).parent().parent().children(':first-child').text()+' akan dihapus! Yakin?'",
			'template'=>'{view}{update}{delete}',
			'buttons'=>array
			(
				'view' => array
				(
					'label'=>'Lihat data',
					'url'=>'array("viewrecordform", "id"=>$data->id_form)'
					//'visible'=>'$data->score > 0',
					//'click'=>'function(){alert("Going down!");}',
				),
				'update' => array
				(
					'label'=>'Ubah data', //'[-]'
					'url'=>'array("ubah", "id"=>$data->id_form)'
					//'visible'=>'$data->score > 0',
					//'click'=>'function(){alert("Going down!");}',
				),
				'delete' => array
				(
					'label'=>'Hapus data',
					'url'=>'array("hapus", "id"=>$data->id_form)'
					//'visible'=>'$data->score > 0',
					//'click'=>'function(){alert("Anda akan menghapus!");}',
				),
			),
		),
	),
)); ?>
