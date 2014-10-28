
<div id="tes" class="btn">Hello World</div>

<?php 
Yii::app()->clientScript->registerScript('tes','            
   
    $("#tes").click(
		function()
		{
			alert("tes");				
		}
	);
	
',CClientScript::POS_END);


?>            

	

