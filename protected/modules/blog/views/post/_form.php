<div class="form">

<?php //$form=$this->beginWidget('CActiveForm'); 
 $form = $this->beginWidget('CActiveForm', array(
        'id' => 'mestre-form',
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
 ));

?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php 		
			$this->widget('ext.amilna.widgets.CkEditor',
				array(
					'model'=>$model,
					'field'=>'content',
					'height'=>200,
					'tipe'=>'all'				
				)
			); 				
		?>
		<p class="hint">You may use <a target="_blank" href="http://daringfireball.net/projects/markdown/syntax">Markdown syntax</a>.</p>
		<?php echo $form->error($model,'content'); ?>
	</div>
	
	<!--
	<div class="row">
			<?php echo $form->labelEx($model,'gambar'); ?>
			<?php echo CHtml::activeFileField($model, 'gambar'); // by this we can upload image ?>  
			<?php echo $form->error($model,'gambar'); ?>
	</div>	
	
	<?php if($model->isNewRecord!='1' && $model->gambar != null){ ?>
	<div class="row">
		<?php 
			$asset = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.blog.assets'), false, -1, defined('YII_DEBUG') && YII_DEBUG);
			echo CHtml::image($asset.'/img/'.$model->gambar,"gambar",array("width"=>200));   // Image shown here if page is update page
		?>
	</div>
	<?php } ?>
	-->
	
	<div class="row">
		<?php echo $form->labelEx($model,'tags'); ?>
		<?php $this->widget('CAutoComplete', array(
			'model'=>$model,
			'attribute'=>'tags',
			'url'=>array('suggestTags'),
			'multiple'=>true,
			'htmlOptions'=>array('size'=>50),
		)); ?>
		<p class="hint">Please separate different tags with commas.</p>
		<?php echo $form->error($model,'tags'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',Lookup::items('PostStatus')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
