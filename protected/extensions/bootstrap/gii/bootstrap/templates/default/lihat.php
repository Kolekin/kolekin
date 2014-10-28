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
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn},
);\n";
?>

$this->menu=array(
	array('label'=>'Indeks <?php echo $this->class2name($this->modelClass); ?>', 'url'=>array('index')),
	array('label'=>'Buat <?php echo $this->class2name($this->modelClass); ?>', 'url'=>array('buat')),
	array('label'=>'Ubah <?php echo $this->class2name($this->modelClass); ?>', 'url'=>array('ubah', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label'=>'Hapus <?php echo $this->class2name($this->modelClass); ?>', 'url'=>'#', 'linkOptions'=>array('submit'=>array('hapus','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'confirm'=>'Anda yakin akan menghapus data ini?')),
	array('label'=>'Atur <?php echo $this->class2name($this->modelClass); ?>', 'url'=>array('atur')),
);

$this->pageTitle = '<h1>Lihat <?php echo $this->class2name($this->modelClass)." #'.\$model->{$this->tableSchema->primaryKey}.'"; ?></h1>';
?>

<?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
<?php
foreach($this->tableSchema->columns as $column)
	echo "\t\t'".$column->name."',\n";
?>
	),
)); ?>
