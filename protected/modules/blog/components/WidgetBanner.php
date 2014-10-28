<?php

class WidgetBanner extends CWidget
{
	public function run()
	{		
		Yii::app()->getModule('blog')->setImport(array(
			'application.modules.blog.models.Banner',			
		));	
		
		$banners = Banner::model()->findAll(
							'status = :id order by posisi',
							array(':id' => 1)
						);
		if ($banners)
		{				
			$this->render('application.modules.blog.components.views.widgetBanner',array(			
				'banners'=>$banners,
			));				
		}
	}

}
