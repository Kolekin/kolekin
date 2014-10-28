<?php
/* @var $this MakeformController */

$this->breadcrumbs=array(
	'Makeform',
);
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'rekapkegpugar-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="row">
	<div class="span12">
		<label>Name Form : </label><input type="text" placeholder="Form Name">
	</div>
</div>
<hr>
<div class="row">
	<div class="span3">
			<label>Type Form</label>
			<select name="selecttype" id="selecttype-input">
				  <option label="Select Your Type"></option>
		          <option value="text">EditText</option>
		          <option value="spinner">Spinner (DropDown)</option>
		          <option value="date">Date</option>
		          <option value="time">Time</option>
		          <option value="label">TextView</option>
		          <option value="image">ImageView</option>
		          
		     </select>
		     <br>
		     <div class="value-properties" id="properties-text">
		     		<Label>Name</Label>
		     		<input type="text" placeholder="Name" id="type-name1" name="type-name"><br/>
		     		<label>Input type</label>
		     		<select name="type-input1" id="type-input1">
		     			<option value="text">Text</option>
		     			<option value="number">Number</option>
		     		</select>
		              <br/>
		             <label>Hint</label>
		             <input type="text" placeholder="Hint" name="type-hint1" id="type-hint1">
		             <a id="type-post1" class="btn btn-primary btn-small" href="#">Send</a>
		             <br/>
		     </div>
		     <div class="value-properties" id="properties-option">
		     		<Label>Name</Label>
		     		<input type="text" placeholder="Name" name="type-name2"><br/>
		     		<label>Input type</label>
		     		<input type="text" name="type-input2" readonly="readonly" id="value-type">
		              <br/>
		             <label>Hint</label>
		             <input type="text" placeholder="Hint" name="type-hint2">
		             <br/>
		             <label>Option</label>
		             <input type="text" placeholder="Option" name="type-option2">
		             <a href="#" id="type-post2" class="btn btn-primary btn-small">Send</a>
		     </div>
		     <div class="value-properties" id="properties-other">
		     		<Label>Name</Label>
		     		<input type="text" placeholder="Name" name="type-name3"><br/>
		     		<label>Input type</label>
		     		<input type="text" readonly="readonly" id="value-type3" name="type-input3">
		             <label>Hint</label>
		             <input type="text" placeholder="Hint" name="type-hint3">
		             <br/>
		            
		             <a href="#" id="type-post3" class="btn btn-primary btn-small">Send</a>
		     </div>

		
	</div>
	<div class="span9" id="content-type">
		<div id="count-result"></div>
		<div id="result-type"></div>
	</div>
</div><!-- End row-->
<?php $this->endWidget(); ?>

<script type="text/javascript">
//ACTION FOR UI SELECTING TYPE INPUT
$('#properties-text').hide();
$('#properties-option').hide();
$('#properties-other').hide();
$('#selecttype-input').change(function() {
	var datatype = $(this).val();
	if($(this).val() == 'text')
	{
		$('#properties-text').show(500);
		$('#properties-other').hide(500);
		$('#properties-option').hide(500);
	}
	else if($(this).val() == 'spinner')
	{
		$('#properties-text').hide(500);
		$('#properties-other').hide(500);
		$('#properties-option').show(500);
	}
	else
	{
		$('#properties-other').show(500);
		$('#properties-option').hide(500);
		$('#properties-text').hide(500);
		$('#value-type3').val(datatype);
	}
});


$('#type-post1').click(function(){
	//var name_post1 = $('#type-name1').getValue();
	var name_post1 =  $('#type-name1').val(),
	    type_post1 = $('#type-input1').val(),
	    hint_post1 = $('#type-hint1').val();
	 console.log(name_post1);
	if(name_post1 !=='' && type_post1 !=='')
	{
		var noOfColumns = $('div #result-type').length;
		var dataPost1 = new Object();
		dataPost1.name = $('#type-name1').val();
		dataPost1.input_type = type_post1;
		dataPost1.hint = hint_post1;
		dataPost1.option = '';
		var myString = JSON.stringify(dataPost1);
		$('#content-type').append( "<div id='result-type' class='alert alert-success'>Test <b>Parent "+noOfColumns+" </b>"+myString+"<button type='button' class='close' data-dismiss='alert'>×</button></div>");
		$('#count-result').append(noOfColumns);
	}
	else
	{
		alert('Silahkan cek data yang tidak boleh kosong');
	}
	

})

// just for the demos, avoids form submit

</script>