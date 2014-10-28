<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>


	<div class="row pull-left" style="margin-right:20px;">
		<?php echo $form->labelEx($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'author'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50,'style'=>'width:100%;')); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>


<?php if(CCaptcha::checkRequirements()): ?>
<div class="row">
	<?php echo $form->labelEx($model,'verifyCode'); ?>
	<div>
	<?php $this->widget('CCaptcha'); ?>
	<?php echo $form->textField($model,'verifyCode'); ?>
	</div>
	<div class="hint">Please enter the letters as they are shown in the image above.
	<br/>Letters are not case-sensitive.</div>
	<?php echo $form->error($model,'verifyCode'); ?>
</div>
<?php endif; ?>

<hr>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save'); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->
