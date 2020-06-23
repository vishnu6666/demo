<style type="text/css">
	.errorBlock {
        color: #FF0000;
        font-weight: normal;
        display: none;
        text-align: left;
        font-size: 12px;
    }
</style>

<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-12 text-left"> 
      <form method="POST" enctype="multipart/form-data" action=''> 
		<input type="hidden" name="id" id="id" value="<?php echo $formdata['id']?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group row">
					<div class="col-sm-12">
						<label for="text" class="block">Name *</label>
					</div>
					<div class="col-sm-12">
						<input type="text" id="text" name="text" class="form-control" value="<?php if(isset($formdata['text'])){ echo $formdata['text']; }?>">
						<span class="errorBlock" id="errortext"></span>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group row">
					<div class="col-sm-12">
						<label for="dropdown" class="block">Education *</label>
					</div>
					<div class="col-sm-12">
						<select id="dropdown" name="dropdown" class="form-control">
							<option value="">Select Option</option>
							<option value="BE" <?php if($formdata['dropdown'] == 'BE'){ echo "selected";} ?>>BE</option>
							<option value="ME" <?php if($formdata['dropdown'] == 'ME'){ echo "selected";} ?>>ME</option>
							<option value="Btech" <?php if($formdata['dropdown'] == 'Btech'){ echo "selected";} ?>>Btech</option>
							<option value="Mtech" <?php if($formdata['dropdown'] == 'Mtech'){ echo "selected";} ?>>Mtech</option>
						</select>
						<span class="errorBlock" id="errordropdown"></span>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group row">
					<div class="col-sm-12">
						<label for="gender" class="block">Gender *</label>
					</div>
					<div class="col-sm-12">
						<input type="radio" id="radio" name="gender" value="male" <?php if($formdata['radio'] == 'male'){ echo "checked";} ?> >Male
						<input type="radio" id="radio" name="gender" value="female" <?php if($formdata['radio'] == 'female'){ echo "checked";} ?>>Female
						<span class="errorBlock" id="errorradio"></span>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group row">
					<div class="col-sm-12">
						<label for="hobby" class="block">Hobby *</label>
					</div>
					<div class="col-sm-12">
						<?php 
						if(isset($formdata['checkbox'])){
							$checkbox = explode(',', $formdata['checkbox']);
							$cricket='';
							$wb='';
							$fb='';

							foreach ($checkbox as $key => $hobbyvalue) {
								if($hobbyvalue == 'cricket'){
									$cricket= 'checked';
								}

								if($hobbyvalue == 'wb'){
									$wb= 'checked';
								}

								if($hobbyvalue == 'fb'){
									$fb= 'checked';
								}
							}?>

							<?php } ?>

							<input type="checkbox" id="checkbox" name="checkbox[]" value="cricket" <?php if(isset($cricket)){ echo $cricket;} ?>>cricket
							<input type="checkbox" id="checkbox" name="checkbox[]" value="wb" <?php if(isset($wb)){ echo $wb;} ?> >wb
							<input type="checkbox" id="checkbox" name="checkbox[]" value="fb" <?php if(isset($fb)){ echo $fb;} ?>>fb
							<span class="errorBlock" id="errorcheckbox"></span>
					</div>
				</div>
				<?php echo form_error('checkbox[]','<p class="text-danger error">','</p>'); ?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group row">
					<div class="col-sm-12">
						<label for="file" class="block">File *</label>
					</div>
					<div class="col-sm-12">
						<input type="file" id="singleFile" name="file" class="form-control">
						<img src="<?php echo base_url('assets/uploads/'.$formdata['singleFile']);?>" height="50px" width="50px">
						<span class="errorBlock" id="errorsingleFile"></span>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group row">
					<div class="col-sm-12">
						<label for="photos" class="block">Gallary *</label>
					</div>
					<div class="col-sm-12">
						<input type="file" id="multiplefile" name="photos[]" multiple="" class="form-control">
						<?php $gallerys = explode(',', $formdata['multiplefile']);?>
	                    <?php foreach($gallerys as $gallery){?>
	                    <img src="<?php echo base_url('assets/uploads/'.$gallery);?>" height="50px" width="50px">
	                    <?php }?>
						<span class="errorBlock" id="errormultiplefile"></span>
					</div>
				</div>
			</div>
		</div>

		<input type="btton" name="submit" value="submit" id="submitform" class="btn btn-info">
	</form>
    </div>
  </div>
</div>

<script type="text/javascript">
	$('#submitform').click(function(){
		var valitated = formValidation();
		if(valitated === true){
			submitformdata();
		}
	});

    //  validation
    function formValidation(){
    	/* start input fild validation */
    	if ($('#text').val().length > 0) {
    		var textRegex = /^[a-zA-Z-' ]+$/.test($('#text').val());
    		if (textRegex === true) {
    			$("#errortext").css("display", "none");
    		} else {
    			$("#errortext").css("display", "block");
    			$('#errortext').html('Only characters are allowed.');
    		}

    	} else {
    		$("#errortext").css("display", "block");
    		$('#errortext').html('Name is required.');
    	}

    	/* start dropdown  validation */
    	if ($('#dropdown').val().length > 0) {
    		$("#errordropdown").css("display", "none");
    	}else {
    		$("#errordropdown").css("display", "block");
    		$('#errordropdown').html('Education is required.');
    	}

    	/* start radio button validation */
    	var radio = $('#radio:checked').val();
    	if (radio =='male' || radio =='female') {
    		$("#errorradio").css("display", "none");
    	} else {
    		$("#errorradio").css("display", "block");
    		$('#errorradio').html('Gender is required.');
    	}

    	/* start checkbox button validation */
    	var checkbox = [];
    	$("#checkbox:checked").each(function() {
    		checkbox.push($(this).val());
    	});
    	
    	var selected;
    	selected = checkbox.join(',') ;
    	
    	if(selected.length > 0){
    		$("#errorcheckbox").css("display", "none");	
    	}else{
    		$("#errorcheckbox").css("display", "block");
    		$('#errorcheckbox').html('Choose at least one Hobby.');
    	}

    	var nullCounter = $(".errorBlock:visible").length;
    	if(nullCounter === 0){
    		return true;
    	}else{
    		return false;
    	}
    }

    function submitformdata()
    {
    	var id = $('#id').val();
    	var text = $('#text').val();
    	var dropdown = $('#dropdown').val();
    	var radio = $("input[name='gender']:checked").val();
    	
	    var checkboxval = [];
	    $("#checkbox:checked").each(function() {
	    	checkboxval.push($(this).val());
	    });
	    var selectcheckboxval;
	    selectcheckboxval = checkboxval.join(',') ;

	    var dataValues = new FormData();

	    dataValues.append('id', id);
	    dataValues.append('text', text);
	    dataValues.append('dropdown', dropdown);
	    dataValues.append('radio', radio);
	    dataValues.append('selectcheckboxval', selectcheckboxval);

	    var singleFile = $("#singleFile").get(0).files.length;
	    if(singleFile > 0){
	    	dataValues.append('singleFile', $("#singleFile").get(0).files[0]);
		}

	    var totalfiles = $("#multiplefile").get(0).files.length;
	    if(totalfiles > 0){
		    for (var index = 0; index < totalfiles; index++) {
		    	dataValues.append("multiplefile[]", $("#multiplefile").get(0).files[index]);
		    }
		}

	    $.ajax({
	    	type: "POST",
	    	data: dataValues,
	    	contentType: false,
	    	cache: false,
	    	processData: false,
	    	dataType: "json",
	    	url: "<?php echo base_url('form/updateform');?>",
	    	success: function (result) {
	    		var objToString = JSON.stringify(result);
	    		var stringToArray = [];
	    		stringToArray.push(objToString);
	    		var jsonObj = $.parseJSON(stringToArray);
	    		var message = jsonObj.Common.Message;
	    		
	    		if (message == "Record updated.") {
	    			window.location.href = "<?php echo base_url('form/index'); ?>";
	    		} else {
                        swal("Wrong", "Something Wrong,try again.)", "error");
                    }
	    	}
	    });
	}
</script>