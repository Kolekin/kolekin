<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id_form',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'form_name',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'id_user',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'json_form',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'created_at',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'last_updated_at',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'form_description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'created_by',array('class'=>'span5','maxlength'=>1)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
