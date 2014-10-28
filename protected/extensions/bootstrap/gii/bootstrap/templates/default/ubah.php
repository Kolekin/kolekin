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
	\$model->{$nameColumn}=>array('lihat','id'=>\$model->{$this->tableSchema->primaryKey}),
	'Ubah',
);\n";
?>

$this->menu=array(
	array('label'=>'Indeks <?php echo $this->class2name($this->modelClass); ?>', 'url'=>array('index')),
	array('label'=>'Buat <?php echo $this->class2name($this->modelClass); ?>', 'url'=>array('buat')),
	array('label'=>'Lihat <?php echo $this->class2name($this->modelClass); ?>', 'url'=>array('lihat', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label'=>'Atur <?php echo $this->class2name($this->modelClass); ?>', 'url'=>array('atur')),
);

$this->pageTitle = '<h1>Ubah <?php echo $this->class2name($this->modelClass)." '.\$model->{$this->tableSchema->primaryKey}.'"; ?></h1>';
?>

<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
