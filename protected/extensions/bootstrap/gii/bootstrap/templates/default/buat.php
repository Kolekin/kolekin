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
	'Buat',
);\n";
?>

$this->menu=array(
	array('label'=>'Indeks <?php echo $this->class2name($this->modelClass); ?>', 'url'=>array('index')),
	array('label'=>'Atur <?php echo $this->class2name($this->modelClass); ?>', 'url'=>array('atur')),
);

$this->pageTitle = '<h1>Buat <?php echo $this->class2name($this->modelClass); ?></h1>';
?>

<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
