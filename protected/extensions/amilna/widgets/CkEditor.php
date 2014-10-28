<?php

class CkEditor extends CWidget
{
	public $model;
	public $field;
	public $tipe='def';
	public $height=100;
	public $width='';
	public $lang='ms';		

	public function run()
	{		
		if ($this->tipe == 'def')
		{
			$toolbar = ',toolbar : [
				["Source","PasteText","-","Maximize"] , 
				["Bold","Italic","Underline", "Strike", "Subscript", "Superscript", "-", "RemoveFormat" ],
				//[ "Styles", "Format", "Font", "FontSize", "-", "TextColor" ],
				[ "Styles", "Format"],
				["NumberedList","BulletedList","-","JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyBlock", "-","Blockquote"],				
				//[ "Image", "Flash", "Table", "HorizontalRule", "Smiley", "SpecialChar"],
				[ "Image", "Table", "HorizontalRule", "Smiley", "SpecialChar"],								
				["Link", "Unlink"]				
			]';
		}
		elseif ($this->tipe == 'min')
		{
			$toolbar = ',toolbar : [
				["Source","PasteText","-","Maximize"] ,
				["Bold","Italic","Underline", "Strike", "Subscript", "Superscript", "-", "RemoveFormat" ],								
				["Link", "Unlink","filebrowser"]
			]';		
		}
		else
		{
			$toolbar = '';			
		}
		
		$height = '';
		if (is_numeric($this->height))
		{
			$height = ',height: '.$this->height.'';	
		}
		
		$width = '';
		if (is_numeric($this->width))
		{
			$width = ',width: '.$this->width.'';	
		}
		
		$filefolder = explode('/',dirname(Yii::app()->basePath));
		$kcfinder = 'kcFinder'.$filefolder[count($filefolder)-1];
		
		$_SESSION[$kcfinder]['disabled'] = false; // enables the file browser in the admin
		$_SESSION[$kcfinder]['uploadURL'] = Yii::app()->baseUrl."/aset2/uploads/"; // URL for the uploads folder
		$_SESSION[$kcfinder]['uploadDir'] = Yii::app()->basePath."/../aset2/uploads/"; // path to the uploads folder
		
		echo CHtml::activeTextArea($this->model,$this->field,array('style'=>'display:none;'));
		
		$id = get_class($this->model).'_'.$this->field;		
		
        $cs = Yii::app()->getClientScript();        
		$cs->registerScriptFile(Yii::app()->baseUrl.'/aset2/ckeditor/ckeditor.js',CClientScript::POS_END);
		$cs->registerScript(__CLASS__.'#ckEditor','
			function ckEditor(id,lopt) 
			{    
				var instance = CKEDITOR.instances[id];
				if(instance)
				{
					CKEDITOR.remove(instance);
				}
				CKEDITOR.replace(id,lopt);    		
			}										
        ',CClientScript::POS_END);
        
		$cs->registerScript(__CLASS__.'#'.$id,'            					
			ckEditor( "'.$id.'", 
				{	
					
					filebrowserBrowseUrl: "'.Yii::app()->baseUrl.'/aset2/kcfinder-2.51/browse.php?type=files",
					filebrowserImageBrowseUrl: "'.Yii::app()->baseUrl.'/aset2/kcfinder-2.51/browse.php?type=images",
					filebrowserFlashBrowseUrl: "'.Yii::app()->baseUrl.'/aset2/kcfinder-2.51/browse.php?type=flash",
					filebrowserUploadUrl: "'.Yii::app()->baseUrl.'/aset2/kcfinder-2.51/upload.php?type=files",
					filebrowserImageUploadUrl: "'.Yii::app()->baseUrl.'/aset2/kcfinder-2.51/upload.php?type=images",
					filebrowserFlashUploadUrl: "'.Yii::app()->baseUrl.'/aset2/kcfinder-2.51/upload.php?type=flash", 								
					
					language: "'.$this->lang.'"
					'.$toolbar.'
					'.$height.'
					'.$width.' 
				}
			);			
			
        ',CClientScript::POS_END);
		
	}
}
