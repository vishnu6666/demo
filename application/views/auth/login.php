<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-4 text-left"> 
       <h1 class="page-title text-center">Admin Login</h1>
    </div>

    <div class="col-sm-8 text-left"> 
      <form method="POST" action="<?php echo base_url('Auth/login')?>">
        <?php
            $error_msg=$this->session->flashdata('error_msg');
         if($error_msg){?>
        <div class="alert alert-danger" role="alert">
            <small><?php echo $error_msg; ?></small>
        </div>
        <?php } ?>
        <br>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email"
                placeholder="Enter your email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password"
                placeholder="Enter your password">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>
        <button class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>

<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 3000);
</script>
    
