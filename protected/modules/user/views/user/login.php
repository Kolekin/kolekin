<table width="100%">
<tr>
<td>
<div class="well well-large">
<?php  $baseUrl = Yii::app()->theme->baseUrl; ?>
<center><img src="<?php echo $baseUrl;?>/img/kkp.png" alt="Logo" height="250px" width="250px"></center>
<br>
<br>
<p>Direktorat Jenderal Kelautan, Pesisir dan Pulau-pulau Kecil.</p>
<p>Kementrian Kelautan dan Perikanan Republik Indonesia</p>
<p>Gedung Mina Bahari 3, Lantai 11</p>
<p>Jakarta Pusat DKI Jakarta</p>
<a href="http://www.kp3k.kkp.go.id/" target="_blank"><p>Website kami</p></a>
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
