<?php
$saya = tb_form::model()->findAll();
?>
<?php
foreach($saya as $row)
{
	echo $row->form_json;
}
?>