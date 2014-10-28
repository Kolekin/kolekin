<?php

if(!empty($_GET['tag'])) {
	$this->pageTitle = '<h1>Postingan Blog dengan Tag <i>'.CHtml::encode($_GET['tag']).'</i></h1>';
}
else
{
	$this->pageTitle = '<h1>Blog <small>Info dan Artikel</small></h1>';
}	
 

$html = array('class'=>'active');
if(isset($_GET['tag']))
{
	if ($_GET['tag'] != '')
	{
		$html = array();
	}	
}
$kategori=array(	
	array('label'=>'Semua Postingan', 'url'=>array('/blog/post'),'itemOptions'=>$html)	
);

$tags = Yii::app()->getModule('blog')->BlogProperties->ambilTags();

foreach ($tags as $tag)
{
	$html = array();
	if(isset($_GET['tag']))
	{
		if ($_GET['tag'] == $tag)
		{
			$html = array('class'=>'active');
		}	
	}
	$mt = array('label'=>Yii::app()->amilna->strToProper($tag), 'url'=>array('/blog/post/index/tag/'.$tag),'itemOptions'=>$html);	
	array_push($kategori,$mt);
}
$this->kategori = $kategori;

$menu=array();
if (Yii::app()->user->isSuperuser)
{
$this->menu=array_merge($menu,array(
	array('label'=>'Buat Postingan', 'url'=>array('/blog/post/create')),	
	array('label'=>'Atur Postingan', 'url'=>array('/blog/post/admin')),
	array('label'=>'Atur Komentar', 'url'=>array('/blog/comment')),
));
}
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{items}\n{pager}",
	'htmlOptions'=>array('style'=>'padding-top:0px;margin-top:-20px;'),
)); ?>

