<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'blog-gallery-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Kolom dengan <span class="required">*</span> harus diisi.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'url',array('class'=>'span5')).' <span class="btn" id="BlogGallery_url_btn">Upload/Pilih Gambar</span>'; ?>

	<?php echo $form->textFieldRow($model,'keterangan',array('class'=>'span5')); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>		
		<?php echo $form->dropDownList($model,'status',array('1'=>'Tampilkan','0'=>'Draft'),array('class'=>'span5'));	?>				
	</div>

	<?php echo $form->textFieldRow($model,'tags',array('class'=>'span5')); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tipe'); ?>		
		<?php echo $form->dropDownList($model,'tipe',array('gambar'=>'Gambar','video'=>'Video'),array('class'=>'span5'));	?>				
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
