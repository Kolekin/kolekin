<?php
$this->breadcrumbs=array(
	$model->title=>$model->url,
	'Update',
);


$html = array();
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
	array('label'=>'Lihat Postingan Ini', 'url'=>array('/blog/post/view/id/'.$_GET['id'])),
	array('label'=>'Buat Postingan', 'url'=>array('/blog/post/create')),	
	array('label'=>'Atur Postingan', 'url'=>array('/blog/post/admin')),
	array('label'=>'Atur Komentar', 'url'=>array('/blog/comment')),
));
}

$this->pageTitle = '<h1>Update '.$model->title.'</h1>';
?>


<?php 

echo $this->renderPartial('_form', array('model'=>$model)); 
            
?>

