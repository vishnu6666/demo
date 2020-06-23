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
<div class="row">
   <h2> Create Form</h2>
</div>   
  <div class="row content">
    <div class="col-sm-12 text-left"> 
      <form method="POST" enctype="multipart/form-data" action=''> 
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
							<option value="BE" <?php if(isset($formdata['dropdown'])){ echo "selected";} ?>>BE</option>
							<option value="ME">ME</option>
							<option value="Btech">Btech</option>
							<option value="Mtech">Mtech</option>
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
						<input type="radio" id="radio" name="gender" value="male" >Male
						<input type="radio" id="radio" name="gender" value="female">Female
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
						<input type="checkbox" id="checkbox" name="hobby[]" value="cricket" >cricket
						<input type="checkbox" id="checkbox" name="hobby[]" value="wb" >wb
						<input type="checkbox" id="checkbox" name="hobby[]" value="fb" >fb
						<span class="errorBlock" id="errorcheckbox"></span>
					</div>
				</div>
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

    // Claim continue validation
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

    	/* start single file  validation */
    	var fileName = $("#singleFile").val();
    	if(fileName) {
    		$("#errorsingleFile").css("display", "none");
    	} else {
    		$("#errorsingleFile").css("display", "block");
    		$('#errorsingleFile').html('Choose Single File.');
    	}

    	/* start multiple file upload validation */
    	if ($("#multiplefile").get(0).files.length > 0) {
    		for (var i = 0; i < $("#multiplefile").get(0).files.length; ++i) {
    			var multiplefile = $("#multiplefile").get(0).files[i].name;
    			if(multiplefile){                        
    				var file_size = $("#multiplefile").get(0).files[i].size;

    				if(file_size<999999999){ 
    					var ext = multiplefile.split('.').pop().toLowerCase();                            
    					if($.inArray(ext,['jpg','jpeg','gif','png'])===-1){
    						$("#errormultiplefile").css("display", "block");
    						$('#errormultiplefile').html('Invalid file extension');
    					}else{
    						$("#errormultiplefile").css("display", "none");
    					}

    				}else{
    					$("#errormultiplefile").css("display", "block");
    					$('#errormultiplefile').html('size is too large.');
    				}                        
    			}else{
    				$("#errormultiplefile").css("display", "block");
    				$('#errormultiplefile').html('fill all fields..');
    			}
    		}
    	}else{
    		$("#errormultiplefile").css("display", "block");
    		$('#errormultiplefile').html('Choose Multiple File.');
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
	    
	    dataValues.append('text', text);
	    dataValues.append('dropdown', dropdown);
	    dataValues.append('radio', radio);
	    dataValues.append('selectcheckboxval', selectcheckboxval);
	    dataValues.append('singleFile', $("#singleFile").get(0).files[0]);

	    var totalfiles = $("#multiplefile").get(0).files.length;

	    for (var index = 0; index < totalfiles; index++) {
	    	dataValues.append("multiplefile[]", $("#multiplefile").get(0).files[index]);
	    }

	    $.ajax({
	    	type: "POST",
	    	data: dataValues,
	    	contentType: false,
	    	cache: false,
	    	processData: false,
	    	dataType: "json",
	    	url: "<?php echo base_url('Form/submitform');?>",
	    	success: function (result) {
	    		var objToString = JSON.stringify(result);
	    		var stringToArray = [];
	    		stringToArray.push(objToString);
	    		var jsonObj = $.parseJSON(stringToArray);
	    		var message = jsonObj.Common.Message;
	    		
	    		if (message == "Record inserted.") {
	    			window.location.href = "<?php echo base_url('Form/index'); ?>";
	    		} else {
	    			swal("Wrong", "Something Wrong,try again.)", "error");
	    		}
	    	}
	    });
	}
</script>