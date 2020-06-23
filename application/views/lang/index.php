
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-12 text-left"> 
		<select onchange="javascript:window.location.href='<?php echo base_url(); ?>LanguageSwitcher/switchLang/'+this.value;">
		    <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
		    <option value="french" <?php if($this->session->userdata('site_lang') == 'french') echo 'selected="selected"'; ?>>French</option>
		    <option value="german" <?php if($this->session->userdata('site_lang') == 'german') echo 'selected="selected"'; ?>>German</option>   
		</select>
		<br><br>
			<p><?php echo $this->lang->line('title'); ?></p>
			<p><?php echo $this->lang->line('welcome_message'); ?></p>
    </div>
  </div>
</div>
