<?php
class Amilna extends CApplicationComponent
{
    private $_assetsUrl;
    private $_assetsPath;
    
    public function __construct() {
        //$this->ambilUrlAsetBukapeta();
    }
	
    public function copyR( $path, $dest )
    {               		
		
        if( is_dir($path) )
        {			
            @mkdir( $dest );
            $objects = scandir($path);
            if( sizeof($objects) > 0 )
            {
                foreach( $objects as $file )
                {
                    if( $file == "." || $file == ".." )
                        continue;
                    // go on
                    if( is_dir( $path.'/'.$file ) )
                    {
                        $this->copyR( $path.'/'.$file, $dest.'/'.$file );
                    }
                    else
                    {
                        copy( $path.'/'.$file, $dest.'/'.$file );
                    }
                }
            }
            return true;
        }
        elseif( is_file($path) )
        {
            return copy($path, $dest);
        }
        else
        {
            return false;
        }
    }
        
	public function globR($file) 
	{		
		$files = glob($file);
		foreach ($files as $file) {			
			if (is_dir($file)) {
				if (($key = array_search($file, $files)) !== false) {
					unset($files[$key]);
				}				
				$files = array_merge($files,$this->globR($file.'/*'));
			}				
		}
		return $files;
	}
	
	public function strToProper($string)
	{
		$res = '';
		$al = explode(" ",$string);	
		foreach ($al as $a) {
			$sl = explode(".",$a);
			if (count($sl) > 1) {
				$res0 = '';
				foreach ($sl as $s) {
					$res0 = $res0.strtoupper(substr($s,0,1)).strtolower(substr($s,1)).'.';
				}
				$res0 = substr($res0,0,-1);
			}
			else {
				$res0 = strtoupper(substr($a,0,1)).strtolower(substr($a,1));	
			}
			$res = $res.$res0.' ';	
		}
		$res = substr($res,0,-1);
		return $res;
	}

	public function ambilUrlAset($pathAset) 
	{
			
			if(empty($pathAset))return false;
			
			$urlAset = '';
			//if($pathAset == 'modules.bukapeta.assets'){			
			if(strstr($pathAset,'extensions') == null){
				//die('application.'.$pathAset);
				$urlAset = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.'.$pathAset),false,-1,YII_DEBUG);				
			}else{
				
				$target = Yii::app()->getBasePath().'/'.str_replace('.','/',$pathAset);
				$pathSegments = explode('.',$pathAset);
				$pathModul = Yii::app()->getBasePath().'/'.$pathSegments[0].'/'.$pathSegments[1];
				$pathAsetWeb = str_replace('/protected','',Yii::app()->getBasePath().'/assets');
				$files = $this->globR($target.'/*');
				
				foreach ($files as $file) 
				{				
						$fileSegments = explode('assets',$file);
						//$link = $this->ambilPathAsetBukapeta().$fileSegments[1];
						$link = Yii::app()->getAssetManager()->getPublishedPath($pathModul.'/assets',false,-1).$fileSegments[1];
						$linkSegments = explode('/',$link);
						$linkDir = '';

						for ($i = 0;$i<count($linkSegments)-1;$i++) {
								$linkDir = $linkDir.$linkSegments[$i].'/';	
								if ($linkDir != '/') {
										if (!file_exists(substr($linkDir,0,-1))) {mkdir(substr($linkDir,0,-1), 0775);}
								}
						}

						if (!file_exists($link) || YII_DEBUG) {
							//symlink($file, $link);
							copy($file, $link);							
						}	
				}
				$urlAset = $link;	
				//$urlAset = Yii::app()->getBaseUrl().'/assets/'.$pathSegments[0].'/'.$pathSegments[1];
//                    $asset = Yii::app()->getAssetManager();
//                    $asset->setBasePath($this->ambilPathAsetBukapeta());
//                    $urlAset = $asset->publish(Yii::getPathOfAlias($pathAset),true,-1);
			}
			return $urlAset;		
	}
	/**
	* @return string the base URL that contains all published asset files of bukapeta module.
	*/
	public function ambilUrlAsetBukapeta()
	{
		if (isset($this->_assetsUrl)){
			return $this->_assetsUrl;
		}		
		else
		{
			$this->_assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.bukapeta.assets'),false,-1);
			return $this->_assetsUrl;
		}
		
	}
	/**
	* @return string the base path that contains all published asset files of bukapeta module.
	*/
	public function ambilPathAsetBukapeta()
	{
		if (isset($this->_assetsPath)){
			return $this->_assetsPath;
		}		
		else
		{
			$this->_assetsPath = Yii::app()->getAssetManager()->getPublishedPath(Yii::getPathOfAlias('application.modules.bukapeta.assets'),false,-1);
			return $this->_assetsPath;
		}
	}


	public function installSqls()
	{
		$items = array();
		
		$path = Yii::app()->getBasePath();
		
		$modulePath = $path.DIRECTORY_SEPARATOR.'modules';
		if( file_exists($modulePath)===true )
		{
			$moduleDirectory = scandir($modulePath);
			foreach( $moduleDirectory as $entry )
			{
				if( substr($entry, 0, 1)!=='.' && $entry!=='rights' )
				{
					$subModulePath = $modulePath.DIRECTORY_SEPARATOR.$entry;
					if( file_exists($subModulePath)===true )
					{
						$items[ $entry ] = glob($subModulePath.'/*.sql');
												
						$moduleExtPath = $subModulePath.DIRECTORY_SEPARATOR.'extensions';
						if( file_exists($moduleExtPath)===true )
						{
							$moduleExtDirectory = scandir($moduleExtPath);
							foreach( $moduleExtDirectory as $ext )
							{
								$extPath = $moduleExtPath.DIRECTORY_SEPARATOR.$ext;
								if( file_exists($extPath)===true )
								{										
									$items[ $entry ][$ext] = glob($extPath.'/*.sql');
								}	
							}	
						}						
					}
				}
			}
		}				
		
		//print_r($items);
		//die();
		$go = true;	
		$error = '';	
		$modules = Yii::app()->modules;
		$prefix = Yii::app()->db->tablePrefix;
		foreach ($modules as $mod=>$module)
		{			
			if (isset($module['class']) && $mod != 'gii')
			{
				$seg = explode('.',$module['class']);								
				if (count($seg) == 4)
				{
					$mod = $seg[2];	
				}																	
			}										
				
			if  (isset($items[$mod]))
			{
				foreach ($items[$mod] as $n=>$sql)
				{										
					if (is_numeric($n))
					{
												
						try {
							$isi = file_get_contents($sql);
							$isi = str_replace(array("'SQL_ASCII'","tbl_"),array("'UTF8'",$prefix),$isi);
							Yii::app()->db->createCommand($isi)->execute();							
						} catch (Exception $e) {							
							if (str_replace('Duplicate table:','',$e) == $e)
							{
								$error .=  $sql.'<br>'.$e.'<hr>';
								$go = false;
							}
						}						
						
					}					
				}				
						
				if (isset($module['extensions']))
				{								
					
					foreach ($module['extensions'] as $ext)
					{
						$ext = strtolower($ext);
												
						if (isset($items[$mod][$ext]))
						{
							foreach ($items[$mod][$ext] as $n=>$sql)
							{				
								try {
									$isi = file_get_contents($sql);
									$isi = str_replace(array("'SQL_ASCII'","tbl_"),array("'UTF8'",$prefix),$isi);
									Yii::app()->db->createCommand($isi)->execute();																
								} catch (Exception $e) {									
									if (str_replace('Duplicate table:','',$e) == $e)
									{
										$error .=  $sql.'<br>'.$e.'<hr>';
										$go = false;
									}
								}								
							}							
						}
						
					}
				}
			}
		}		
		
		if (!$go)		
		{
			die($error);
		}	
				
		$rights = Yii::app()->getModule('rights');
		$rights->setComponents(array(
				'installer'=>array(
					'class'=>'RInstaller',
					'superuserName'=>$rights->superuserName,
					'authenticatedName'=>$rights->authenticatedName,
					'guestName'=>Yii::app()->user->guestName,
					'defaultRoles'=>Yii::app()->authManager->defaultRoles,
				),
			));
		Yii::app()->getUser()->id = 1;
		$rights->getComponent('installer')->run();
		Yii::app()->getUser()->id = 0;
		
		$modulePath = $path.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'rights';
		if( file_exists($modulePath)===true )
		{
			$items['rights'] = glob($modulePath.DIRECTORY_SEPARATOR.'*.sql');
			foreach ($items['rights'] as $n=>$sql)
			{										
				if (is_numeric($n))
				{
					try {
						$isi = file_get_contents($sql);
						$isi = str_replace(array("'SQL_ASCII'","tbl_"),array("'UTF8'",$prefix),$isi);
						Yii::app()->db->createCommand($isi)->execute();							
					} catch (Exception $e) {							
						if (!(str_replace('Duplicate table:','',$e) != $e || str_replace('Unique violation:','',$e) != $e))
						{
							$error .=  $sql.'<br>'.$e.'<hr>';
							$go = false;
						}
					}
				}					
			}
		}	
		
		if (!$go)		
		{
			die($error);
		}	
		return true;
	}    
	
	public $uangSimbol = 'Rp. ';
	public $uangDesimal = ',';
	public $uangRibuan = '.';
	
    function strToUang($value, $symbol=true)
	{
		
		if(!is_numeric($value))
		{
			return;
		}				
		
		if($value < 0 )
		{
			$neg = '- ';
		} else {
			$neg = '';
		}
			
		$formatted = number_format(abs($value), 2, $this->uangDesimal, $this->uangRibuan);
		
		if($symbol)
		{
			$formatted = $neg.$this->uangSimbol.' '.$formatted;
		}
		
		return $formatted;

	}	
	
	function strToUangGrafik($value, $symbol=true)
	{
		
		if(!is_numeric($value))
		{
			return;
		}				
		
		if($value < 0 )
		{
			$neg = '- ';
		} else {
			$neg = '';
		}
			
		$formatted = number_format(abs($value), 2, $this->uangDesimal, $this->uangRibuan);
		
		if($symbol)
		{
			$formatted = $neg.$this->uangSimbol.'. '.$formatted;
		}
		
		return $formatted;

	}	
	
	function strToKodeBarang($value, $symbol=true)
	{
		
		if(!is_numeric($value))
		{
			return;
		}				
		
		if($value < 0 )
		{
			$neg = '- ';
		} else {
			$neg = '';
		}
		
		$value = str_split($value); // [2,1,2,1,2,3,1,2,3,4]
		//$value = array_reverse($value); // [4,3,2,1,3,2,1,2,1,2]
		
		array_splice($value, 1, 0, '.'); // [1,-,2,3,4,5,6,7,8,9,10]
		array_splice($value, 4, 0, '.'); // [1,-,2,3,-,4,5,6,7,8,9,10]
		array_splice($value, 7, 0, '.'); // [1,-,2,3,-,4,5,-,6,7,8,9,10]
		array_splice($value, 10, 0, '.'); // [1,-,2,3,-,4,5,-,6,7,-,8,9,10]
		
		
		//$value = array_reverse($value); // [2,1,2,-,1,2,3,-,1,2,3,4]
		$value = implode($value); // "212-123-1234"
		
		$formatted = $value;
		
		if($symbol)
		{
			$formatted =' '.$formatted;
		}
		
		return $formatted;

	}
	
	function strToLokasiBarang($value, $symbol=true)
	{
		
		
		$value = str_split($value); // [2,1,2,1,2,3,1,2,3,4]
		//$value = array_reverse($value); // [4,3,2,1,3,2,1,2,1,2]
		
		array_splice($value, 3, 0, '.'); // [1,-,2,3,4,5,6,7,8,9,10]
		array_splice($value, 6, 0, '.'); // [1,-,2,3,-,4,5,6,7,8,9,10]
		array_splice($value, 11, 0, '.'); // [1,-,2,3,-,4,5,-,6,7,8,9,10]
		array_splice($value, 18, 0, '.'); // [1,-,2,3,-,4,5,-,6,7,-,8,9,10]
		array_splice($value, 22, 0, '.'); // [1,-,2,3,-,4,5,-,6,7,-,8,9,10]
		
		//$value = array_reverse($value); // [2,1,2,-,1,2,3,-,1,2,3,4]
		$value = implode($value); // "212-123-1234"
		
		$formatted = $value;
		
		if($symbol)
		{
			$formatted =' '.$formatted;
		}
		
		return $formatted;

	}

}
?>
