<?php

class BlogProperties extends CApplicationComponent
{
	public function ambilTags()
    {
		$tags = array();					
		$sql= "SELECT tags FROM ".Yii::app()->db->tablePrefix."blog_post WHERE status=2 group by tags";
		$ts =  Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($ts as $t)
		{
			$tl = explode(',',$t['tags']);
			foreach ($tl as $tag)
			{
				$tag = trim($tag);
				if (!in_array($tag,$tags))
				{
					array_push($tags,$tag);
				}
			}				
		}	
		
		return $tags;	
	}
}

?>
