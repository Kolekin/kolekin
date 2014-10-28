<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Atur',
);\n";
?>

$this->menu=array(
	array('label'=>'Indeks <?php echo $this->class2name($this->modelClass); ?>', 'url'=>array('index')),
	array('label'=>'Buat <?php echo $this->class2name($this->modelClass); ?>', 'url'=>array('buat')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#<?php echo $this->class2id($this->modelClass); ?>-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

$this->pageTitle = '<h1>Atur <?php echo $this->pluralize($this->class2name($this->modelClass)); ?></h1>';
?>



<p>
Anda dapat memasukan operator perbandingan (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
atau <b>=</b>) di awal kata pencarian untuk mendapatkan hasil pencarian yang spesifik.
</p>

<?php echo "<?php echo CHtml::link('Pencarian Lanjutan','#',array('class'=>'search-button')); ?>"; ?>

<div class="search-form" style="display:none">
<?php echo "<?php \$this->renderPartial('_search',array(
	'model'=>\$model,
)); ?>\n"; ?>
</div><!-- search-form -->

<?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	'responsiveTable' => true,
	'filter'=>$model,
	'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
	echo "\t\t'".$column->name."',\n";
}
if($count>=7)
	echo "\t\t*/\n";
?>
		
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
