
<br>
<table width="100%">
<tr>
<td>
<div class="well well-large">
<?php  $baseUrl = Yii::app()->theme->baseUrl; ?>
<center><img src="<?php echo $baseUrl;?>/img/logotut.png" alt="Logo" height="250px" width="250px"></center>
<br>
<br>
<p>Direktorat Jenderal Kebudayaan.</p>
<p>Jl. Jend. Sudirman, Senayan</p>
<p>Kompek Kemdikbud, Gedung E Lt.4</p>
<p>Jakarta 10270</p>
<a href="http://kebudayaan.kemdikbud.go.id/" target="_blank"><p>Website kami</p></a>
</div>
</td>
<td>
<?php
$this->widget(
    'bootstrap.widgets.TbBox',
    array(
        'title' => 'Login',
        'headerIcon' => 'icon-user',
        //'content' => 'My Basic Content (you can use renderPartial here too :))'
        //'content' => $this->renderPartial('/user/aboutus', array('model'=>$model), true)
        'content' =>  $this->renderPartial('/user/halamanlogin', array('model'=>$model,'o'=>$o), true)
    )
);
?>
</td>
</tr>
</table>
