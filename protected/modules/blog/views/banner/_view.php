<?php
/* @var $this BannerController */
/* @var $data Banner */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('lihat', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gambar')); ?>:</b>
    <div class="row">
    <?php 
    /*****************/
    
    if ($data->gambar == null || $data->gambar == '') { } 
    else {		            
	
		if (!isset($_GET['id'])) {
			echo '<div class="blog-image" style="margin-left:30px;">';
			$sz = 'width=230';			
		}
		else {
			echo '<div class="blog-image" style="margin-left:30px;">';
			$sz = '';
		}	
	
	?>
	
	<img src="<?php 
		//$asset = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.blog.assets'), false, -1, defined('YII_DEBUG') && YII_DEBUG);
		$asset = Yii::app()->getBaseUrl().'/aset2/uploads/images/';  				
		echo $asset;
	?><?php echo $data->gambar;?>" alt="<?php echo $data->gambar;?>" <?php echo $sz;?>/>
	</div><!-- blog-image -->
    
    <?php } ?>
    </div>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keterangan')); ?>:</b>
	<?php echo CHtml::encode($data->keterangan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode(Banner::itemAlias("BannerStatus",$data->status)); ?>
	<br />


</div>
<hr>
