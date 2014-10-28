<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
       </a>
     
          <!-- Be sure to leave the brand out there if you want it shown -->
          
          <div class="nav-collapse">
			  <a class="brand" href="#">KP3K<small> </small></a>
			<?php $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'pull-right nav'),
                    'id'=>'myMenu',
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>array(
                        array('label'=>'Beranda', 'url'=>array('/'), 'view'=>'/default/index'),
                        array('label'=>'KKJI <span class="caret"></span>', 'url'=>array('#'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown", 'id'=>'Pengaturan_menu'),  
							'items'=>array(																
								array('label'=>'Jenis Kawasan', 'url'=>array('/kp3k/jnskws'), 'view'=>'admin'),
								
							)
						), 
                       
						array('label'=>'TTRL <span class="caret"></span>', 'url'=>array('#'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown", 'id'=>'Pengaturan_menu'),  
							'items'=>array(																
								array('label'=>'Perencanaan', 'url'=>array('/kp3k/perencanaan'), 'view'=>'admin'),
								
							)
						),
						
						
						array('label'=>'P3K <span class="caret"></span>', 'url'=>array('#'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown", 'id'=>'Pengaturan_menu'),  
							'items'=>array(																
								array('label'=>'Indikator Kinerja Kegiatan', 'url'=>array('/kp3k/ikk'), 'view'=>'admin'),
								array('label'=>'Investasi Pulau', 'url'=>array('/kp3k/investasi'), 'view'=>'admin'),
								array('label'=>'Sarana Prasarana Pulau Pulau Kecil', 'url'=>array('/kp3k/kinerja'), 'view'=>'admin'),
								array('label'=>'Pulau Prioritas', 'url'=>array('/kp3k/pulauprioritas'), 'view'=>'admin'),
							)
						), 
						array('label'=>'PL <span class="caret"></span>', 'url'=>array('#'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown", 'id'=>'Pengaturan_menu'),  
							'items'=>array(																
								array('label'=>'Fasilitas Umum dan Air Bersih', 'url'=>array('/kp3k/fuairbersih'), 'view'=>'admin'),
								array('label'=>'PDPT', 'url'=>array('/kp3k/pdpt'), 'view'=>'admin'),
								array('label'=>'Rehabilitasi Pesisir', 'url'=>array('/kp3k/rehabpssr'), 'view'=>'admin'),
							)
						),  
						array('label'=>'PMPU <span class="caret"></span>', 'url'=>array('#'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown", 'id'=>'Pengaturan_menu'),  
							'items'=>array(																
								array('label'=>'Database SPDN', 'url'=>array('/kp3k/dataspdn'), 'view'=>'admin'),
								array('label'=>'Rekap Kegiatan PUGAR', 'url'=>array('/kp3k/rekapkegpugar'), 'view'=>'admin'),
								array('label'=>'Realisasi Penyaluran BLM PUGAR', 'url'=>array('/kp3k/penyalurblmpugar'), 'view'=>'admin'),
								array('label'=>'Sebaran Petambak Garam PUGAR', 'url'=>array('/kp3k/sebaranpetambakgaram'), 'view'=>'admin'),
								array('label'=>'Data Produksi Garam Rakyat', 'url'=>array('/kp3k/produksigaramrakyat'), 'view'=>'admin'),
							)
						), 
						//array('label'=>'Peta', 'url'=>array('/kp3k/buka/peta'), 'view'=>'/default/index'),
						array('label'=>'Pengaturan <span class="caret"></span>', 'url'=>array('#'),'visible'=>(Yii::app()->user->isSuperuser?true:false),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown", 'id'=>'Pengaturan_menu'),  
							'items'=>array(																
								array('label'=>'Blog - Artikel', 'url'=>array('//blog/post/admin'), 'view'=>'admin'),
								array('label'=>'Pengaturan - User', 'url'=>array('//user/admin'), 'view'=>'admin'),						
								array('label'=>'Pengaturan - Hak Akses', 'url'=>array('//rights/authItem/permissions'), 'view'=>'view'),								
								array('label'=>'Pengaturan - Hak Akses User', 'url'=>array('//rights/assignment'), 'view'=>'view'),
							)
						), 
						array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Logout  (<i class="icon-user"></i>'.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)

                    ),
                )); ?>
		</div>
	</div>
</div>


