<?php
class Template 
{
	public function full_admin_html($content)
	{
		$CI =& get_instance();
		$data = array(
						'title' => 'Home',
						'content' 	=> $content,
					);
		$content = $CI->parser->parse('admin_html_template', $data);
	}
}



?>