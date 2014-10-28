<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);

?>

<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="alert alert-success">
	<p><?php echo Yii::app()->user->getFlash('registration'); ?></p>
</div>
<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
<div class="alert alert-success">
	<p><?php echo Yii::app()->user->getFlash('recoveryMessage'); ?></p>
</div>
<?php endif; ?>

<?php echo CHtml::beginForm(); ?>
	<div class="form span5" style="margin-left: 400px;">
		<br><p><?php echo UserModule::t("Please fill out the following form with your login credentials:"); ?></p>
		
		<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
			
		<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

		<div class="alert alert-success">
			<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
		</div>
		<?php endif; ?>	
		
		<?php if($model->hasErrors()):?>
		<div class="alert alert-error">
		  <?php echo CHtml::errorSummary($model); ?>
		</div>	
		<?php endif; ?>
		<br><div class="row">
			<?php echo CHtml::activeLabelEx($model,'username'); ?>
			<?php echo CHtml::activeTextField($model,'username') ?>
		</div>
		
		<div class="row">
			<?php echo CHtml::activeLabelEx($model,'password'); ?>
			<?php echo CHtml::activePasswordField($model,'password') ?>
		</div>
		<br>
		<div class="row">
			<p class="hint">
			<?php echo CHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
			</p>
		</div>
		
		<div class="row rememberMe">
			<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
			<?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
		</div>				
		<br>
	
		<div class="row" >	
		<?php echo CHtml::submitButton(UserModule::t("Login"),array('class'=>'btn btn-primary')); ?>
		</div>				

	</div><!-- form -->

	
			<?php		
				if ($o)
				{					
					echo '<div class="form-actions span5">';
					$this->widget('ext.hoauth.widgets.HOAuth');										
					echo '</div>';
				}        
			?>	
	
<?php echo CHtml::endForm(); ?>



<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>
