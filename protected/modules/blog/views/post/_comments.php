<?php foreach($comments as $comment): ?>
<div class="row-fluid comment" id="c<?php echo $comment->id; ?>">

	<?php echo CHtml::link("#{$comment->id}", $comment->getUrl($post), array(
		'class'=>'cid',
		'title'=>'Permalink to this comment',
	)); ?>

	<span class="time">
		on <?php echo date('F j, Y \a\t h:i a',$comment->create_time); ?>,
	</span>
	
	<span class="author">
		<?php echo $comment->authorLink; ?> says:
	</span>
	
	<div class="content">
		<?php echo nl2br(CHtml::encode($comment->content)); ?>
	</div>

</div><!-- comment -->
<?php endforeach; ?>
