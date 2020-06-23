<div class="container-fluid text-center">  
<div class="row">
   <h2> Edit Menu</h2>
</div>   
  <div class="row content">
    <div class="col-sm-12 text-left"> 
      <form method="POST" enctype="multipart/form-data" action='<?php echo base_url('Category/category_update');?>'> 
      	<input name ="s1" type="hidden" value="<?php echo $this->uri->segment(3);?>">
		<input name ="s2" type="hidden" value="<?php echo $this->uri->segment(4);?>">
		<input name ="s3" type="hidden" value="<?php echo $this->uri->segment(5);?>">
		<input name ="s4" type="hidden" value="<?php echo $this->uri->segment(6);?>">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group row">
					<div class="col-sm-12">
						<label for="text" class="block">category name *</label>
					</div>
					<div class="col-sm-12">
						<input type="text" id="text" name="category_name" class="form-control" value="<?php if(isset($category_name)){ echo $category_name; }?>">
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" value="<?php echo $category_id;?>" name="category_id">
		<input type="submit" id="add-cat" class="btn btn-success btn-large" name="add-cat" value="save changes" />
	</form>
    </div>
  </div>
</div>
