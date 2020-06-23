<div class="container-fluid text-center">  
<div class="row">
</div>  
  <div class="row content">
    <div class="col-sm-6 text-center"> 
    <a href="<?php echo base_url('Csv/exportcsv')?>" ><button class="btn btn-danger mb-2">Export Csv</button></a>
    </div>
    <div class="col-sm-6 text-center"> 

    	<?php if (isset($error)): ?>
                <div class="alert alert-error"><font color="red"><?php echo $error; ?></font></div>
        <?php endif; ?>

    	<form method="post" action="<?php echo base_url() ?>Csv/importcsv" enctype="multipart/form-data">
    		<div class="col-sm-6">
				<input type="file" name="userfile" autofocus="" id="text" class="form-control" required="">
			</div>
			<div class="col-sm-6">
				<input type="submit" name="submit" value="Import Csv" class="btn btn-primary">
			</div>
        </form>
    </div>
  </div>
</div>
