<?php
	require_once('../base/startup.php');
	require_once(BASEPATH.'/base/C_Base.php');
	require_once(BASEPATH.'/model/M_Photo.php');
	
	class Photos extends C_Base
	{
		private static $instance;       // ссылка на экземпляр класса
		private $photoes;
		
		public function __construct() 
		{
			$this->Request();
    	}
		
		public static function Instance() 
		{
			if (self::$instance == null)
				self::$instance = new Photos();
	
			return self::$instance;
    	}
		
		protected function OnInput()
		{
			if($_GET)
			{
				$mPhoto = M_Photo::Instance();
				$idArt = $_GET['page'];
				
				$Phtos = $mPhoto->getPhotos($_GET['page']);
				$this->photoes['pictures'] = $Phtos;
				//$this->photoes['num'] = count($Phtos);
				$this->photoes['pagination'] = $mPhoto->Page_nav();
			}
		}
		
		protected function OnOutput() 
		{
        	$content = $this->View(BASEPATH.'/view/v_ulPhoto.php', $this->photoes);
			echo $content;
    	}
	}
	$obAddCom = Photos::Instance();
	