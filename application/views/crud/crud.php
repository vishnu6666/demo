<div class="container-fluid text-center">  
<div class="row">
    <a href="<?php echo base_url('crud/create')?>" ><button class="btn btn-primary">Create</button></a>
</div>  
  <div class="row content">
    <div class="col-sm-12 text-left"> 
      <table class="table table-striped table-bordered nowrap dataTable dt-responsive" style="width:100%">
          <thead>
            <tr>
                <th>IT's No</th>
                <th>Name</th>
                <th>Education</th>
                <th>Gender</th>
                <th>Hobby</th>
                <th>File</th>
                <th>Photos</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if($formdatas){?>
                <?php foreach($formdatas as $key => $formdata){?>
                <tr>
                    <td><?php echo $key+1;?></td>
                    <td><?php echo $formdata['text'];?></td>
                    <td><?php echo $formdata['dropdown'];?></td>
                    <td><?php echo $formdata['radio'];?></td>
                    <td><?php echo $formdata['checkbox'];?></td>
                    <td>
                        <img src="<?php echo base_url('assets/uploads/'.$formdata['singleFile']);?>" height="50px" width="50px">
                    </td>
                    <td>
                        <?php $gallerys = explode(',', $formdata['multiplefile']);?>
                        <?php foreach($gallerys as $gallery){?>
                        <img src="<?php echo base_url('assets/uploads/'.$gallery);?>" height="50px" width="50px">
                        <?php }?>
                    </td>
                    <td>
                        <a href="<?php echo base_url('crud/edit/'.$formdata['id']) ?>" >
                            <button class="btn btn-primary">Edit</button>
                        </a>
                        <button onclick="deletedata('<?php echo $formdata['id']?>')" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                <?php }?>
            <?php }?>
          </tbody>
        </table>
    </div>
  </div>
</div>


<script type="text/javascript">
    $(document).ready(function()
    {
        $('.table').DataTable({
        });
    })

    function deletedata(id){
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this Data.",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete!",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {

                $.ajax({
                    url: "<?php echo base_url('form/delete/')?>" + id,
                    type: "POST",
                    success: function (data) {
                        swal({
                            title: 'Success!',
                            type: 'success',
                            focusConfirm: false,
                            timer: 2000,
                        });
                        window.setTimeout(function () {
                            location.reload();
                        }, 2000);
                    },
                    error: function () {
                        alert('Not Closed');
                    }
                });
            } else {
                swal("Cancelled", "Your Data is safe :)", "error");
            }
        });
    }
</script>