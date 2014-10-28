<div class="blog-item-container">
            
    <?php 
    
    $lg = explode('src="',$data->content);
    
    if (count($lg) > 1)
    {
		$lg = explode('"',$lg[1]);	
		$g = $lg[0];
	    $data->gambar = $g; 
	}
	else
	{
		$data->gambar = null;
	}    
    
    if ($data->gambar == null || $data->gambar == '') { } 
    else {		            
	
		if (!isset($_GET['id'])) {
			echo '<div class="blog-image pull-left">';
			$sz = 'width=230';			
		}
		else {
			echo '<div class="blog-image" style="display:none;">';
			$sz = '';
		}	
	
	?>
	
	<img src="<?php 
		//$asset = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.blog.assets'), false, -1, defined('YII_DEBUG') && YII_DEBUG);
		$asset = Yii::app()->getBaseUrl().'/aset2/uploads/images/';  				
		//echo $asset;
	?><?php echo $data->gambar;?>" alt="<?php echo $data->gambar;?>" <?php echo $sz;?>/>
	</div><!-- blog-image -->
    
    <?php } 
    
    if (!isset($_GET['id'])) {
    ?>
         	        
	<div class="blog-title">
	<h3><?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?></h3>
	</div><!-- blog-title -->
	
	<?php } ?> 
            
	<div class="blog-details">
		<ul>
		  <li><i class="icon-calendar"></i><?php echo date('F j, Y',$data->create_time); ?></li>
		  <li><i class="icon-comment"></i><?php echo CHtml::link("Comments ({$data->commentCount})",$data->url.'#comments'); ?></li>
		  <li><a href="#"><i class="icon-user"></i><?php echo $data->author->username;?></a></li>
		 <!-- <li><a href="#"><i class="icon-th-list"></i> Backend Design</a></li> -->
		  <li><i class="icon-tags"></i><?php echo implode(', ', $data->tagLinks); ?></li>
		  
		  <?php
				Yii::app()->clientScript->registerScript("","            
				$('a.view-code').click(function(){
					var title=$(this).attr('rel');
					$.fancybox.showActivity();
					$.ajax({
						type: 'POST',
						cache: true,
						url: $(this).attr('href'),						
						success: function(data){
							$.fancybox(data,{
								'title': title,
								'titlePosition': 'inside',
								'titleFormat': function(title, currentArray, currentIndex, currentOpts) {
									return '<div id=\"tip7-title\"><span><a href=\"javascript:;\" onclick=\"$.fancybox.close();\">close</a></span>' + (title && title.length ? '<a href=\"javascript:;\" onclick=\"$.fancybox.close();\"><b>' + title + '</b></a>' : '' ) + '</div>';
								},
								'showCloseButton': false,
								'autoDimensions': false,
								'width': 900,
								'height': 'auto',
								'onComplete':function(){
									$('#fancybox-inner').scrollTop(0);
								}
							});
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
							$.fancybox('<div class=\"error\">'+XMLHttpRequest.responseText+'</div>');
						}
					});
					return false;
				});
					
				",CClientScript::POS_END);
		  ?>
		</ul>
	</div><!-- blog-details -->
    
    <!--        
	<div class="blog-tags">
		<i class="icon-tags"></i><?php echo implode(', ', $data->tagLinks); ?>
	</div><!-- blog-tags -->	
            
	<div class="blog-text">
       <?php
			$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			if (!isset($_GET['id'])) 
			{
				//$sinopsis = $data->content;
				$sinopsis = strip_tags($data->content);
				if (strlen($sinopsis) > 300) {
					$sinopsis = wordwrap($sinopsis, 300);
					$sinopsis = substr($sinopsis, 0, strpos($sinopsis, "\n"));						    
				}
				
				//$sinopsis = strip_tags($sinopsis);
				echo '<p>'.$sinopsis.'</p>';
			}
			else
			{	
				echo $data->content;
			}	
			$this->endWidget();
		?>
	</div><!-- blog-text -->
        
    <?php if (!isset($_GET['id'])) { ?>        
	<div class="blog-read-more">
		<p>
			<?php echo CHtml::link('Read more..', $data->url); ?>
	   </p>
	</div><!-- blog-read-more -->
	<?php } ?>
            
</div><!-- blog-item-container -->
<hr />
            
