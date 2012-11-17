<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class Controller
{
	protected $title;
	protected $content;
	
	function __construct()
	{
	}
	
	public function Request()
	{
		$this->OnInput();
		$this->OnOutput();
	}
	
	protected function OnInput()
	{
		$this->title = SITE_NAME;
		$this->content = '';
	}
	
	protected function OnOutput()
	{
		$vars = array('title' => $this->title, 'content' => $this->content);
		$page = $this->View(BASE_TMP, $vars);
		echo $page;
	}
	
	protected function View($fileName, $vars = array())
	{
		foreach($vars as $k => $v)
		{
			$$k = $v;
		}
		
		ob_start();
		include $fileName;
		return ob_get_clean();
	}
}