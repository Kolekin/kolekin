<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile"),
);

$this->menu=((UserModule::isAdmin())
		?array(array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')))
		:array());

$this->menu = array_merge(
	$this->menu,
	array(	
		array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
		array('label'=>UserModule::t('Edit'), 'url'=>array('edit')),
		array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
		array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
	));
	
$this->widget('bootstrap.widgets.TbDetailView', array(
		'data'=>array(),		
	));

?><h1><?php echo UserModule::t('Your profile'); ?></h1>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>

<table class="detail-view table table-striped table-condensed" id="yw1">

	
	<tr class="odd">
		<th><?php echo CHtml::encode($model->getAttributeLabel('username')); ?></th>
	    <td><?php echo CHtml::encode($model->username); ?></td>
	</tr>
	<?php 
		$n = 0;
		$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
		if ($profileFields) {
			foreach($profileFields as $field) {
				//echo "<pre>"; print_r($profile); die();
			?>
	<tr class="<?php echo ($n % 2 == 0?'even':'odd');?>">
		<th><?php echo CHtml::encode(UserModule::t($field->title)); ?></th>
    	<td><?php echo (($field->widgetView($profile))?$field->widgetView($profile):CHtml::encode((($field->range)?Profile::range($field->range,$profile->getAttribute($field->varname)):$profile->getAttribute($field->varname)))); ?></td>
	</tr>
			<?php
				$n=$n+1;
			}//$profile->getAttribute($field->varname)
		}
	?>
	<tr class="<?php echo ($n % 2 == 0?'even':'odd');?>">
		<th><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
    	<td><?php echo CHtml::encode($model->email); ?></td>
	</tr>
	<tr class="<?php echo ($n % 2 != 0?'even':'odd');?>">
		<th><?php echo CHtml::encode($model->getAttributeLabel('create_at')); ?></th>
    	<td><?php echo $model->create_at; ?></td>
	</tr>
	<tr class="<?php echo ($n % 2 == 0?'even':'odd');?>">
		<th><?php echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?></th>
    	<td><?php echo $model->lastvisit_at; ?></td>
	</tr>
	<tr class="<?php echo ($n % 2 != 0?'even':'odd');?>">
		<th><?php echo CHtml::encode($model->getAttributeLabel('status')); ?></th>
    	<td><?php echo CHtml::encode(User::itemAlias("UserStatus",$model->status)); ?></td>
	</tr>
</table>
