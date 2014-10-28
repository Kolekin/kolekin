<?php
/* @var $this GalleryController */
/* @var $data BlogGallery */
?>

<li class="span4" style="margin:5px;">
	<a href="<?php echo $data->url;?>"  rel="lightbox" class="thumbnail">
		<div class="background"><img src="<?php echo $data->url;?>" alt="<?php echo $data->keterangan;?>" title="<?php echo $data->keterangan;?>" class="img-polaroid"></div>
	</a>
</li>
