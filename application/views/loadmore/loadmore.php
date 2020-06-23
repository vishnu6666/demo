<div class="container-fluid text-center">  
  <div class="row content">
    <div class="col-sm-12 text-center"> 

	<table width="100%" border="1" >
		<tr>
			<th align="center">Id</th>
			<th align="center">Data</th>
		</tr>
	        <?php
	        if (isset($loadData) && !empty($loadData)) {
	            foreach ($loadData as $data) {
	                ?>
	                	<tr class="message_box" data-id="<?php echo $data['id']; ?>">
	                		<td><?php echo $data['id']; ?></td>
	                		<td><?php echo $data['text']; ?></td>
	                	</tr>
	                <?php 
	            }
	        }
	        ?>
	</table>

    <center>
		<lottie-player id="msg_loader" src="https://assets10.lottiefiles.com/packages/lf20_yV8p42.json"  background="transparent"  speed="1"  style="width: 100px; height: 100px;"  loop  autoplay></lottie-player>
	</center>

    </div>
  </div>
</div>

<script>
    var base_url = "<?php echo site_url(); ?>";
    $("#msg_loader").hide();
    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                var msg_id = $(".message_box:last").data("id");
                $("#msg_loader").show();
                $.ajax({
                    type: "POST",
                    url: base_url + "Loadmore/load_messages",
                    data: {msg_id: msg_id},
                    cache: false,
                    dataType: 'json',
                    success: function (data) {
                        if (data.result == "Success") {
                            //Insert data after the message_box 
                            $(".message_box:last").after(data.page);
                            $("#msg_loader").hide();
                        } else {
                            console.log(data.msg);
                        }
                    }
                });
            }
        });
    });
</script>
