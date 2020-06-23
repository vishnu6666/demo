
<div class="container-fluid text-center">  
	<div class="row">
		<h2> Create Form</h2>
	</div>   
	<div class="row content">
		<div class="col-sm-12 text-left"> 
			<form method="POST" action="<?php echo base_url('crud/edit/'.$formdata['id'])?>" enctype='multipart/form-data'>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group row">
							<div class="col-sm-12">
								<label for="text" class="block">Category Name *</label>
							</div>
							<div class="col-sm-12">
								<input type="text" autofocus="" name="text" id="text" class="form-control" value="<?php if(isset($formdata['text'])){ echo $formdata['text']; }?>">
							</div>
						</div>      
						<?php echo form_error('text','<p class="text-danger error">','</p>'); ?>
					</div>
					<div class="col-md-6">
						<div class="form-group row">
							<div class="col-sm-12">
								<label for="dropdown" class="block">Education *</label>
							</div>
							<div class="col-sm-12">
								<select id="dropdown" name="dropdown" class="form-control">
									<option value="">Select Option</option>
									<option value="BE" <?php if(isset($formdata['dropdown']) && $formdata['dropdown'] =='BE'){ echo "selected";} ?> >BE</option>
									<option value="ME" <?php if(isset($formdata['dropdown']) && $formdata['dropdown'] =='ME'){ echo "selected";} ?> >ME</option>
									<option value="Btech" <?php if(isset($formdata['dropdown']) && $formdata['dropdown'] =='Btech'){ echo "selected";} ?> >Btech</option>
									<option value="Mtech" <?php if(isset($formdata['dropdown']) && $formdata['dropdown']=='Mtech'){ echo "selected";} ?> >Mtech</option>
								</select>
							</div>
						</div>
						<?php echo form_error('dropdown','<p class="text-danger error">','</p>'); ?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group row">
							<div class="col-sm-12">
								<label for="radio" class="block">Gender *</label>
							</div>
							<div class="col-sm-12">
								<input type="radio" id="radio" name="radio" value="male" <?php if($formdata['radio'] == 'male') echo "checked='checked'"; ?>>Male
								<input type="radio" id="radio" name="radio" value="female" <?php if($formdata['radio'] == 'female') echo "checked='checked'"; ?> >Female
							</div>
						</div>
						<?php echo form_error('radio','<p class="text-danger error">','</p>'); ?>
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
									<!-- <span class="errorBlock" id="errorcheckbox"></span> -->
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
								<input type="file" id="singleFile" name="singleFile" class="form-control">
								<img src="<?php echo base_url('assets/uploads/'.$formdata['singleFile']);?>" height="50px" width="50px">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group row">
							<div class="col-sm-12">
								<label for="photos" class="block">Gallary *</label>
							</div>
							<div class="col-sm-12">
								<input type="file" id="multiplefile" name="multiplefile[]" multiple="" class="form-control">
								<?php if(isset($formdata['multiplefile'])){?>
								<?php $multiplefile = explode(',', $formdata['multiplefile']);
									foreach ($multiplefile as $key => $multiple) {
								?>
								<img src="<?php echo base_url('assets/uploads/'.$multiple);?>" height="50px" width="50px">
								<?php }?>
								<?php }?>
							</div>
						</div>
					</div>
				</div>

					<input type="submit" name="submit" value="submit" id="submitform" class="btn btn-info">
				</form>
			</div>
		</div>
	</div>
