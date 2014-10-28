<?php
/* @var $this GalleryController */
/* @var $model BlogGallery */

$this->breadcrumbs=array(
	'Blog Galleries'=>array('index'),
	'Buat',
);

$this->menu=array(
	array('label'=>'Indeks Blog Gallery', 'url'=>array('index')),
	array('label'=>'Atur Blog Gallery', 'url'=>array('atur')),
);

$this->pageTitle = '<h1>Buat Blog Gallery</h1>';
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->getBaseUrl().'/aset2/fancybox/jquery.fancybox-1.3.1.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/aset2/fancybox/jquery.fancybox-1.3.1.pack.js',CClientScript::POS_END);

$filefolder = explode('/',dirname(Yii::app()->basePath));
$kcfinder = 'kcFinder'.$filefolder[count($filefolder)-1];

$_SESSION[$kcfinder]['disabled'] = false; // enables the file browser in the admin
$_SESSION[$kcfinder]['uploadURL'] = Yii::app()->baseUrl."/aset2/uploads/"; // URL for the uploads folder
$_SESSION[$kcfinder]['uploadDir'] = Yii::app()->basePath."/../aset2/uploads/"; // path to the uploads folder


Yii::app()->clientScript->registerScript('kc','	

$("#BlogGallery_url_btn").click(
	function()
	{
		var divName = $(this).attr("id").replace("_btn","");
		openKCFinder_singleFile(divName);		
	}
);

function openKCFinder_singleFile(divName,kcversi) {
    var urlS = "http://'.$_SERVER["SERVER_NAME"].Yii::app()->getBaseUrl().'";
    var svrN = "http://'.$_SERVER['SERVER_NAME'].'";
    
    window.KCFinder = {};
    window.KCFinder.callBack = function(url) {
        // Actions with url parameter here        
        $("#"+divName).val(svrN+url);
        $("#"+divName).change();
        window.KCFinder = null;
    };
    var left  = ($(window).width()/2)-(900/2);
	var top   = ($(window).height()/2)-(600/2);    
    var kcurl = urlS+"/aset2/"+(kcversi+"" != "undefined" ? kcversi : "kcfinder-2.51")+"/browse.php";
    //window.open(kcurl, "popup");
    
    var data = "<iframe src=\""+kcurl+"\" style=\"width:840px;height:440px;margin:20px;\"/>";
    
    var title="Pilih Gambar";
	$.fancybox.showActivity();
	
	$.fancybox(data,{
		"title": title,
		"titlePosition": "inside",
		"titleFormat": function(title, currentArray, currentIndex, currentOpts) {
			return "<div id=\"tip7-title\"><span><a href=\"javascript:;\" onclick=\"$.fancybox.close();\">close</a></span>" + (title && title.length ? "<a href=\"javascript:;\" onclick=\"$.fancybox.close();\"></a>" : "" ) + "</div>";
		},		
		"showCloseButton": false,
		"autoDimensions": false,
		"width": 900,
		"height": 500,
		"onComplete":function(){
			$("#fancybox-inner").scrollTop(0);
		}
	});	
}
',CClientScript::POS_END);

?>
