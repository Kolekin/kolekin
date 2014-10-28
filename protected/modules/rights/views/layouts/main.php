<?php $this->beginContent(Rights::module()->appLayout); ?>

<section class="main-body">
    
<div id="rights" class="container">

	<div id="content">

		<?php if( $this->id!=='install' ): ?>

			<div id="menu">

				<?php $this->renderPartial('/_menu'); ?>

			</div>

		<?php endif; ?>

		<?php $this->renderPartial('/_flash'); ?>

		<?php echo $content; ?>

	</div><!-- content -->

</div>

</section>
<?php $this->endContent(); ?>
