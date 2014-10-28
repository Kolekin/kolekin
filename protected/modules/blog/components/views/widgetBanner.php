<?php 
	/*	
	echo '<div id="banners">';	
	$banner_count	= 1;
	foreach ($banners as $banner)
	{
		echo '<div class="banner_container">';
		
		if($banner->link != '')
		{
			$target	= false;
			if($banner->link)
			{
				$target = 'target="_blank"';
			}
			echo '<a href="'.$banner->link.'" '.$target.' >';
		}
		$asset = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.blog.assets'), false, -1, defined('YII_DEBUG') && YII_DEBUG);
		echo '<img class="banners_img'.$banner_count.'" src="'.$asset.'/img/'.$banner->gambar.'" />';
		
		if($banner->link != '')
		{
			echo '</a>';
		}

		echo '</div>';

		$banner_count++;
	}
	
	echo '</div>';
	
	Yii::app()->clientScript->registerScript('banner','            
             
	var rotate;

	var cnt	= 0;

	function rotate_banner()
	{
		//stop the animations from going nuts when returning from minimize
		$(".banner_container:eq("+cnt+")").fadeOut();
		cnt++;
		if(cnt == $(".banner_container").size())
		{
			cnt = 0;
		}
		$(".banner_container:eq("+cnt+")").fadeIn(function(){
			setTimeout("rotate_banner()", 3000);
		});
	}

	$(".banner_container").each(function(item)
	{
		if(item != 0)
		{
			$(this).hide();
		}
	});
	
	
	if($(".banner_container").size() > 1)
	{		
		rotate_banner();
	}

    ',CClientScript::POS_END);
	
	*/
?>



<?php 

	echo '    <div class="slider-bootstrap"><!-- start slider -->
					<div class="slider-wrapper theme-default">
						<div id="slider-nivo" class="nivoSlider">';
						
				$banner_count	= 1;
				foreach ($banners as $b=>$banner)
				{					
					
					if($banner->link != '')
					{
						$target	= false;
						if($banner->link)
						{
							$target = 'target="_blank"';
						}
						echo '<a href="'.$banner->link.'" '.$target.' >';
					}
					
					if ($b == 2)
					{
						$dtrans = 'data-transition="slideInLeft"';	
					}
					else
					{
						$dtrans = '';	
					}
					
					//$asset = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.blog.assets'), false, -1, defined('YII_DEBUG') && YII_DEBUG);
					$asset = Yii::app()->getBaseUrl().'/aset2/uploads/images/';  				
					
					echo '<img src="'.$asset.$banner->gambar.'" data-thumb="'.$asset.$banner->gambar.'" alt="'.$banner->gambar.'" title="'.$banner->keterangan.'" '.$dtrans.'/>';
					
					if($banner->link != '')
					{
						echo '</a>';
					}
				

					$banner_count++;
				}
				
	echo '        </div>
			</div>
		</div> <!-- /slider -->';
			
	Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/nivo-slider/jquery.nivo.slider.pack.js',CClientScript::POS_END);
	Yii::app()->clientScript->registerScript('banner','            

	  $(function() {
			$("#slider-nivo").nivoSlider({
				effect: "boxRandom",
				manualAdvance:false,
				controlNav: false
				});
		});
		
    ',CClientScript::POS_END);		
?>            
