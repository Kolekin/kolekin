<?php
/* @var $this BannerController */
/* @var $model Banner */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'banner-form',
	'enableAjaxValidation'=>false,
	 'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
			<?php echo $form->labelEx($model,'gambar'); ?>
			<?php echo CHtml::activeFileField($model, 'gambar'); // by this we can upload image ?>  
			<?php echo $form->error($model,'gambar'); ?>
	</div>
	<?php if($model->isNewRecord!='1' && $model->gambar != null){ ?>
	<div class="row">
		<?php 
			//$asset = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.blog.assets'), false, -1, defined('YII_DEBUG') && YII_DEBUG);
			$asset = Yii::app()->getBaseUrl().'/aset2/uploads/images/';  				
			echo CHtml::image($asset.$model->gambar,"gambar",array("width"=>200));   // Image shown here if page is update page
		?>
	</div>
	<?php } ?>

	<div class="row">
		<?php echo $form->labelEx($model,'keterangan'); ?>
		<?php echo $form->textField($model,'keterangan'); ?>
		<?php echo $form->error($model,'keterangan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link'); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'posisi'); ?>
		<?php echo $form->numberField($model,'posisi'); ?>
		<?php echo $form->error($model,'posisi'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->checkBox($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
	
	<hr>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
