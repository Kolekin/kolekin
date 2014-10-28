<?php
/* @var $this Tb_formController */
/* @var $data tb_form */
?>

<div class="view" >

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_form')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_form), array('lihat', 'id'=>$data->id_form)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('form_name')); ?>:</b>
	<?php echo CHtml::encode($data->form_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user')); ?>:</b>
	<?php echo CHtml::encode($data->id_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('json_form')); ?>:</b>
	<?php echo CHtml::encode($data->json_form); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->last_updated_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('form_description')); ?>:</b>
	<?php echo CHtml::encode($data->form_description); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	*/ ?>

</div>
<hr>
