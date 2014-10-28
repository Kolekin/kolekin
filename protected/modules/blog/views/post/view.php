<?php
$this->breadcrumbs=array(
	'Blog'=>array('//blog/post'),
	$model->title,
);
$this->pageTitle='<h1>'.$model->title.'</h1>';

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
	array('label'=>'Ubah Postingan Ini', 'url'=>array('/blog/post/update/id/'.$_GET['id'])),
	array('label'=>'Buat Postingan', 'url'=>array('/blog/post/create')),	
	array('label'=>'Atur Postingan', 'url'=>array('/blog/post/admin')),
	array('label'=>'Atur Komentar', 'url'=>array('/blog/comment')),
));
}
?>

<?php if(Yii::app()->user->hasFlash('commentSubmitted')): ?>
	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
	</div>				
<?php endif; ?>	

<?php $this->renderPartial('_view', array(
	'data'=>$model,
)); ?>

<div id="comments" class="blog-comments-container">
	<?php if($model->commentCount>=1): ?>
		<h3>
			<?php echo $model->commentCount>1 ? $model->commentCount . ' comments' : 'One comment'; ?>
		</h3>

		<?php $this->renderPartial('_comments',array(
			'post'=>$model,
			'comments'=>$model->comments,
		)); ?>
	<?php endif; ?>

	<h3>Tinggalkan Komentar</h3>

		<?php $this->renderPartial('/comment/_form',array(
			'model'=>$comment,
		)); ?>
	

</div><!-- comments -->

