<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Restore");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Restore"),
);
?>

<h1><?php echo UserModule::t("Restore"); ?></h1>

<?php if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
<div class="alert alert-success">
<?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
</div>
<?php else: ?>


<?php echo CHtml::beginForm(); ?>
	<div class="form">
	
	<?php if($form->hasErrors()):?>
	<div class="alert alert-error">
	  <?php echo CHtml::errorSummary($form); ?>
	</div>	
	<?php endif; ?>	
	
	
	<div class="row">
		<?php echo CHtml::activeLabel($form,'login_or_email'); ?>
		<?php echo CHtml::activeTextField($form,'login_or_email') ?>
		<p class="hint"><?php echo UserModule::t("Please enter your login or email addres."); ?></p>
	</div>
	</div><!-- form -->
	<div class="row submit form-actions">
		<?php echo CHtml::submitButton(UserModule::t("Restore"),array('class'=>'btn btn-primary')); ?>
	</div>

<?php echo CHtml::endForm(); ?>

<?php endif; ?>
