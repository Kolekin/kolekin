<?php
/* @var $this Tb_formController */
/* @var $model tb_form */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tb-form-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<?php 
$today = date("d-m-Y_G:i");      

?>

<style>
  h1 { padding: .2em; margin: 0; }
  #products { float:left; width: 500px; margin-right: 2em; }
  /*#cart { width: 200px; float: left; margin-top: 1em; }*/
  /* style the list to maximize the droppable hitarea */
  #cart ol { margin: 0; padding: 1em 0 1em 3em; }
  </style>
  <script>
  var obj = new Object();
  $(function() {
    // $( "#catalog" ).accordion();
    $( "#catalog li" ).draggable({
	      appendTo: "body",
	      helper: "clone"
    });
    
    $(".option-value").hide();
    $("#text-json").hide();
    $("#created_by").hide();
    $("#id_user_hide").hide();
    $("#modify_at_hide").hide();
    $("#reload").hide();

    $( "#cart ol" ).droppable({
	      activeClass: "ui-state-default",
	      hoverClass: "ui-state-hover",
	      accept: ":not(.ui-sortable-helper)",
	      drop: function( event, ui ) {
	      	var text_ui = ui.draggable.text();
	      	var random_id = Math.floor(Math.random()*999999);
	      	var baru = new Object();
	    		baru.id = random_id;
	    		baru.name = text_ui;
	    		if (text_ui == 'EditText')
	    		{
	    		    baru.input_type = "text";
	    		    document.getElementById("value-type3").value ="text";
	    		}
	    		else if(text_ui == "Number")
	    		{
	    			baru.input_type ="numeric";
	    			document.getElementById("value-type3").value ="numeric";
	    		}
	    		else if(text_ui == "Spinner (DropDown)")
	    		{
	    			baru.input_type = "spinner";
	    			document.getElementById("value-type3").value ="spinner";

	    		}
	    		else if(text_ui == "Date" )
	    		{
	    			baru.input_type = "date";
	    			document.getElementById("value-type3").value ="date";

	    		}
	    		else if(text_ui == "Time")
	    		{
	    			baru.input_type = "time";
	    			document.getElementById("value-type3").value ="time";

	    		}
	    		else if(text_ui == "TextView")
	    		{
	    			baru.input_type ="label";
	    			document.getElementById("value-type3").value ="label";

	    		}
	    		else if(text_ui == "ImageView")
	    		{
	    			baru.input_type = "image";
	    			document.getElementById("value-type3").value ="image";

	    		}
	    		baru.hint = "";
	    		baru.options = "";
    		var jsonAsString = JSON.stringify(baru);
	    
	      	var inisayabro = document.getElementById("tampungini").value = "field-form-id "+random_id;
	      	document.getElementById("input_id").value = random_id;
	      	$("#cart ol").find( ".placeholder" ).remove();
	        $( "<li class='ui-state-default' id='ampun'><a href='#' class='btn' onclick='updatePopUp(this)'><span class='ui-icon ui-icon-arrowthick-2-n-s'></span><b>"+text_ui+"</b><i> "+inisayabro+"</i> <input class='sementara' type='hidden' id='"+inisayabro+"' value='"+jsonAsString+"' name='user'/><i class='icon-pencil' id='edit_button'></i></a><button type='button' class='close' data-dismiss='alert'>×</button></li>" ).appendTo("#cart ol");
	     	// $("<button id='saya'>Kirenius Denatali Daeli</button>").appendTo('.jomblo');
	     	$('#myModal').modal('toggle');

	     	if(text_ui == "Spinner (DropDown)")
	     	{
	     		  $(".option-value").show();
	     	}
	     	else
	     	{
	     		$(".option-value").hide();
	     	}	
	     	document.getElementById("myModalLabel").innerHTML = "Type input form "+inisayabro;
      }
    }).sortable({
      items: "li:not(.placeholder)",
      sort: function() {
        // gets added unintentionally by droppable interacting with sortable
        // using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
        $( this ).removeClass( "ui-state-default" );
      }
    });

    //if save after edit or input
    $("#save").click(function(){
    	 $(".option-value").hide();
    	var id_musiman = $("#tampungini").val();

    	var obj_star = new Object();
    		obj_star.id = $("#input_id").val();
    		obj_star.name = $("#input_name_type").val();
    		obj_star.input_type = $("#value-type3").val();
    		obj_star.hint = $("#type-hint3").val();
    		//obj_star.options = $("#input_option").val();
    		option_con = $("#input_option").val();
	    		option_con = option_con.replace("/,/gi", "|");
	    		obj_star.options = option_con;
	    		console.log(option_con);
    		
    		var jsonAsString = JSON.stringify(obj_star );
    		 var ini_datasaya = $(".ui-state-default input").val();

   			 console.log(ini_datasaya);
   			 document.getElementById("input_name_type").value = '';
   			 document.getElementById("value-type3").value = '';
   			 document.getElementById("type-hint3").value = '';
   			 document.getElementById("input_option").value = '';
   			document.getElementById("text-json").value = ini_datasaya;
    		document.getElementById(id_musiman).value = jsonAsString; // fungsi untuk menyimpan data
    		
    });

    $("#close").click(function(){
    	$(".option-value").hide();
    });




    //function for calling edit field input form
    function saya()
    {

    	var saya = $(this);
    	console.log(saya);
    	var oksaya = saya.find("input").val();
    	//Get Object JSON
    	var jadi_apa = jQuery.parseJSON(oksaya);

    	// alert(oksaya);
    	$("#myModalEdit").modal("toggle");
    	

    	document.getElementById("input_id_edit").value = jadi_apa.id;
    	document.getElementById("input_name_type_edit").value = jadi_apa.name;
    	document.getElementById("value-type_edit").value = jadi_apa.input_type;
    	document.getElementById("type-hint_edit").value = jadi_apa.hint;
    	document.getElementById("option_edit").value = jadi_apa.options;
    	console.log(jadi_apa.input_type);
    	if(jadi_apa.input_type == "spinner")
    	{
    		$(".option-value_edit").show();
    	}
    	else
    	{
    		$(".option-value_edit").hide();
    	}
    	// console.log(oksaya);

    	console.log(jadi_apa);
    	// document.getElementById("#myModalLabel").innerHTML = "";

  //   	var obj = jQuery.parseJSON( '{ "name": "John" }' );
		// //alert( obj.name === "John" );
		// console.log(obj);
    }
   

    $(".ui-widget-content").mouseover(function(){
    		var rei_cetak = new Array();
    		var rei_buttom = new Array();
    		//var array_bersih = new Array();
			 $('.ui-state-default').each(function () {
			 	
			    var item = $(this); //this should represent one row
			    // var name = item.find('.name').text();
			    var andar = item.find('input').val();
				
			 	if(andar !== '') {
			     	rei_cetak.push(andar);
			 	}
			     
				// }
				 // document.getElementById("text-json").value =  rei_cetak;
			});    
			//console.log(rei_cetak);
			 document.getElementById("text-json").value = rei_cetak;
			 var id_ubah = $("#text-json").val();
			 var belum =   id_ubah.replace(",,,,,,,","");
			 var jadi = belum.replace(",,,,,","");
			 var form_json_super = '{"form_json":['+jadi+']}';
			 //var form_json_super = jadi;

			 document.getElementById("text-json").value = form_json_super ;
	});


    // $(".ui-widget-content").change(function(){
    // 	document.getElementById("text-json").value = "inirei";
    // });
	$( document ).ready(function() {
	 		// $( "#cart ol" ).find("#ampun").remove(); //remove dulu baru di tambahkan
	 		var knp = $("#text-json").val();
	 		var jd = jQuery.parseJSON(knp);
	 		//console.log(jd);
	 		var tampungsaya = [];

	 		//proses membuat ulang ketika update / di reload page tetap pada posisi semula
	 		$.each(jd,function(key,data){
	 			// console.log(data[0]);
	 			// // console.dir(key);
	 			// console.log(key);
	 			// // $("#each-json-saya p").html("<b>"+data[0]+"</b>");
	 			// tampungsaya.push(data[0]["id"])
	 			$.each(data,function(dd,sa){
	 				$("#cart ol").find( ".placeholder" ).remove();
	 				$( "#cart ol" ).find("#ampun").remove();
	 				console.log(sa.id);
	 				var anjrit;
	 				var json_formater;
	 				var apa = document.getElementById("tampungini").value = "field-form-id "+sa.id;
	 				json_formater = '{"id":"'+sa.id+'","name":"'+sa.name+'","input_type":"'+sa.input_type+'","hint":"'+sa.hint+'","options":"'+sa.options+'"}'; //make json format to value hidden
	 				// console.log(json_formater);
	 				
	 			   
		    		anjrit = "<li class='ui-state-default' id='ampun'><a href='#' class='btn' onclick='updatePopUp(this)'><span class='ui-icon ui-icon-arrowthick-2-n-s'></span><b>"+sa.name+"</b><i> "+apa+"</i> <input class='sementara' type='hidden' id='"+apa+"' value='"+json_formater+"' name='user'/><i class='icon-pencil' id='edit_button'></i></a><button type='button' class='close' data-dismiss='alert'>×</button></li>";
		    		
		 				tampungsaya.push(anjrit);
		 			});
	 			
	 		});

	 		document.getElementById("reload").value = tampungsaya;
	        $(tampungsaya).click(saya).appendTo("#cart ol");

	 });   
	
	


	 $("#save-edit").click(function(){
    	 $(".option-value").hide();
    	var id_musiman = $("#tampungini").val();

    	var obj_star = new Object();
    		console.log(obj_star);
    		obj_star.id = $("#input_id_edit").val();
    		obj_star.name = $("#input_name_type_edit").val();
    		obj_star.input_type = $("#value-type_edit").val();

    		obj_star.hint = $("#type-hint_edit").val();

    		option_con = $("#option_edit").val();
    		option_con = option_con.replace(",", "|");
    		obj_star.options = option_con;
    		//obj_star.options = "saya";//$("#input_option").val();
    		
    		var jsonAsString = JSON.stringify(obj_star );
    		 var ini_datasaya = $(".ui-state-default input").val();

   			 console.log(ini_datasaya);
   			 document.getElementById("input_id_edit").value = '';
   			 document.getElementById("input_name_type_edit").value = '';
   			 document.getElementById("value-type_edit").value = '';
   			 document.getElementById("type-hint_edit").value = '';
   			document.getElementById("option_edit").value = ini_datasaya;
    		document.getElementById(id_musiman).value = jsonAsString;

    		
    });

	

  }); //END Script

//Proses Update
function updatePopUp(saya)
	{
		// alert("inibudi mama");
		// console.log(saya);
		var jika = saya.getElementsByTagName("input")[0].value;
		console.log(jika);
		var jadi_apa = jQuery.parseJSON(jika);

    	// alert(oksaya);
    	$("#myModalEdit").modal("toggle");
    	
    	var ini_aku = jadi_apa.options;
    	ini_aku = ini_aku.replace("|",",");

    	document.getElementById("input_id_edit").value = jadi_apa.id;
    	document.getElementById("input_name_type_edit").value = jadi_apa.name;
    	document.getElementById("value-type_edit").value = jadi_apa.input_type;
    	document.getElementById("type-hint_edit").value = jadi_apa.hint;
    	document.getElementById("option_edit").value = ini_aku;
    	console.log(jadi_apa.input_type);
    	if(jadi_apa.input_type == "spinner")
    	{
    		$(".option-value_edit").show();
    	}
    	else
    	{
    		$(".option-value_edit").hide();
    	}
    	// console.log(oksaya);

    	console.log(jadi_apa);
	}
  </script>
<style>
  #catalog { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #catalog li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
  #catalog li span { position: absolute; margin-left: -1.3em; }

</style>
  
	
	<!-- Tempat Tampung Data -->

 <textarea id="reload"></textarea>
 <!-- End Tampung Data -->


  <div id="products" class="span4">
  <h1 class="ui-widget-header">My Form</h1>
  <div >
    <h2><a href="#">Type Input</a></h2>
 	<div class="row">
		<?php echo $form->labelEx($model,'form_name'); ?>
		<?php echo $form->textField($model,'form_name'); ?>
		<?php echo $form->error($model,'form_name'); ?>
	</div>
      <ul id="catalog">
      <input type="hidden" id="tampungini">
         <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>EditText</li>
         <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Number</li>
         <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Spinner (DropDown)</li>
         <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Date</li>
         <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Time</li>
         <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>TextView</li>
         <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>ImageView</li>
      </ul>
      <!-- <input type="hidden" name="tb_form[json_form]" id="text-json"> -->
    <div class="row">
		<?php echo $form->labelEx($model,'form_description'); ?>
		<?php echo $form->textArea($model,'form_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'form_description'); ?>
		<!-- Condition Hide -->
		<?php echo $form->textArea($model,'json_form',array('rows'=>6, 'cols'=>50,"id"=>"text-json")); ?>
		<?php echo $form->textField($model,'created_by',array('rows'=>6, 'cols'=>50,"id"=>"text-json",'id'=>"created_by","value"=>Yii::app()->user->name)); ?> <!--Get Name User-->
		<?php echo $form->textField($model,'last_updated_at',array('rows'=>6, 'cols'=>50,"id"=>"text-json",'id'=>"modify_at_hide","value"=>$today)); ?><!--Get Id User-->
		<?php echo $form->textField($model,'id_user',array('rows'=>6, 'cols'=>50,"id"=>"text-json",'id'=>"id_user_hide","value"=>Yii::app()->user->getId())); ?>
		<!-- End Hide -->
		
	</div>
    	<div class="form-actions span12">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>
  </div>
</div>
 
<div id="cart" class="span6">
  <h1 class="ui-widget-header" style="border:0px;">This my input form</h1>
  <div class="ui-widget-content" style="height:500px;border:0px">
    <ol>
      <li class="placeholder">Drag Over Here</li>
    </ol>
  </div>
</div>

<!-- Modal input-->
<div id="list-modal" >
	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<input type="hidden" id="tampungid"> <!-- Tempat Tampung Id-->
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Modal header</h3>
		</div>
		<div class="modal-body">
			<label>ID</label>
			<input type="text" readonly="readonly" id="input_id" name="type-input3">
			<label>Name</label>
			<input type="name_type" placeholder="Name Type .." name="name_type" id="input_name_type">
			<label>Input type</label>
			<input type="text" readonly="readonly" id="value-type3" name="type-input3">
			<label>Hint</label>
			<input type="text" placeholder="Hint" name="type-hint3" id="type-hint3">
			<div class="option-value">
				<label>Option</label>
				<textarea rows="3" cols="20" placeholder="to separate options must use commas as separators " id="input_option"></textarea>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true" id="close">Close</button>
				<button class="btn btn-primary" id="save" data-dismiss="modal" aria-hidden="true">Save changes</button>
			</div>
		</div>
</div>


<!--Modal Update-->
<div id="list-modal" >
	<div id="myModalEdit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
		<input type="hidden" id="tampungid"> <!-- Tempat Tampung Id-->
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Modal header</h3>
		</div>
		<div class="modal-body">
		<label>ID</label>
		<input type="text" readonly="readonly" id="input_id_edit" name="type-input3">
		<label>Name</label>
		<input type="name_type" placeholder="Name Type .." name="name_type" id="input_name_type_edit">
		<label>Input type</label>
		<input type="text" readonly="readonly" id="value-type_edit" name="type-input3">
		<label>Hint</label>
		<input type="text" placeholder="Hint" name="type-hint_edit" id="type-hint_edit">
		<div class="option-value_edit">
				<label>Option</label>
				<textarea rows="3" cols="20" placeholder="to separate options must use commas as separators" id="option_edit"></textarea>
			</div>
		</div>
		<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true" id="cancel">Close</button>
		<button class="btn btn-primary" id="save-edit" data-dismiss="modal" aria-hidden="true">Save changes</button>
		</div>
	</div>
</div>





<?php $this->endWidget(); ?>

</div><!-- form -->