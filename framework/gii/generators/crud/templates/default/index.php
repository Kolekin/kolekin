<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $dataProvider CActiveDataProvider */

<?php
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label',
);\n";
?>

$this->menu=array(
	array('label'=>'Buat <?php echo $this->class2name($this->modelClass); ?>', 'url'=>array('buat')),
	array('label'=>'Atur <?php echo $this->class2name($this->modelClass); ?>', 'url'=>array('atur')),
);

$this->pageTitle = '<h1><?php echo $label; ?></h1>';
?>


<?php echo "<?php"; ?> $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
