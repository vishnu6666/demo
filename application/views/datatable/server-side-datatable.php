
<div class="container-fluid text-center">   
  <div class="row content">
    <div class="col-sm-12 text-left"> 
        <table id="Basicform" class="table table-striped table-bordered nowrap dataTable dt-responsive" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Education</th>
                    <th>Gendar</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
    </div>
  </div>
</div>


<script type="text/javascript">
	$(document).ready(function () {
        $('#Basicform').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "<?php echo base_url('Datatable/get_form_data') ?>",
                "dataType": "json",
                "type": "POST",
                "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },
            "columns": [
                
                { "data": "text" },
                { "data": "dropdown" },
                { "data": "radio" },
                { "data": "status" },
                { "data": "cdate" },
                { "data": "udate" },
                { "data": "actions" },
            ]
        });    
    });


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
                    url: "<?php echo base_url('Datatable/delete/')?>" + id,
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