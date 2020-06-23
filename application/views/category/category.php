<div class="container-fluid text-center">    
  <div class="row content">
      <!-- Alert Message -->
          <?php
              $message = $this->session->userdata('message');
              if (isset($message)) {
          ?>
          <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <?php echo $message ?>                    
          </div>
          <?php 
              $this->session->unset_userdata('message');
              }
              $error_message = $this->session->userdata('error_message');
              if (isset($error_message)) {
          ?>
          <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <?php echo $error_message ?>                    
          </div>
          <?php 
              $this->session->unset_userdata('error_message');
              }
          ?>
    <div class="col-sm-12 text-left"> 
      <?php if($this->uri->segment(3)==''){ ?>
      <a href="<?php echo base_url('Category'.$this->uri->segment(3)); ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Add Menu">Add Menu
      </a>
      <?php }?>
      <?php if($this->uri->segment(3)!=''){ ?>
      <a href="<?php echo base_url('Category/category_submenu/'.$this->uri->segment(3)); ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Add Menu">Add Sub Menu </a>
      <?php }?>
      <br><br>
      
      <table hight="100%" width="100%" border="1">
      	<tr class="text-center">
      		<td><b>SrNo</b></td>
      		<td><b>Menu</b></td>
      		<td><b>Action</b></td>
      	</tr>

            <?php
                  if ($category_list) {
                  ?>
                  <?php foreach($category_list as $category){?>
                        <tr class="text-center">
                              <td><?php echo $category['sl'];?></td>
                              <td><?php echo $category['category_name'];?></td>
                              <td>
                                    <center>
                                    <?php echo form_open()?>
                                        <?php if($level == 0){ ?>                         
                                                <a href="<?php echo base_url('Category/manage_category/'.$category['id']); ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Sub Menu">Sub Menu
                                                </a>
                                          <?php } ?>
                                          <a href="" class="DeleteCategory btn btn-danger btn-sm" name="<?php echo $category['category_id'];?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo 'delete' ?> ">delete</a>
                                          
                                          <a href="<?php echo base_url('Category/category_update_form/'.$category['category_id']); ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo 'update' ?>">update</a>
                                    <?php echo form_close()?>
                                    </center>
                              </td>
                        </tr>
                  <?php }?>
                  <?php
                        }
                  ?>
      </table>
    </div>
  </div>
</div>

<!-- Delete Category ajax code -->
<script type="text/javascript">
      //Delete Category 
      $(".DeleteCategory").click(function()
      {     
            var category_id=$(this).attr('name');
            var csrf_test_name=  $("[name=csrf_test_name]").val();
            var x = confirm("Are You Sure,Want to Delete ?");
            if (x==true){
            $.ajax
               ({
                        type: "POST",
                        url: '<?php echo base_url('Category/category_delete')?>',
                        data: {category_id:category_id,csrf_test_name:csrf_test_name},
                        cache: false,
                        success: function(datas)
                        {
                              alert(datas);
                        } 
                  });
            }
      });
</script>