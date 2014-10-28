<?php

Yii::import('zii.widgets.CPortlet');

class TagCloud extends CPortlet
{
	public $title='Tags';
	public $maxTags=20;
	public $htmlOptions=array(
				'class'=>'tag'				
			);

	protected function renderContent()
	{
		
		$tags=Tag::model()->findTagWeights($this->maxTags);

		foreach($tags as $tag=>$weight)
		{
			$link=CHtml::link(CHtml::encode($tag), array('//blog/post/index','tag'=>$tag));
			$html = array_merge(array('style'=>"font-size:{$weight}pt"),$this->htmlOptions);
			echo CHtml::tag('span', $html, $link)."\n";
		}
	}
}
