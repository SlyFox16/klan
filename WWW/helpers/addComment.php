<?php
	require_once('../base/startup.php');
	require_once(BASEPATH.'/base/C_Base.php');
	require_once(BASEPATH.'/model/M_Articles.php');
	
	class Add_Comment extends C_Base
	{
		private static $instance;       // ссылка на экземпляр класса
		private $all_comments; // Текст всех комментариев
		
		public function __construct() 
		{
			$this->Request();
    	}
		
		public static function Instance() 
		{
			if (self::$instance == null)
				self::$instance = new Add_Comment();
	
			return self::$instance;
    	}
		
		protected function OnInput()
		{
			$mArticles = M_Articles::Instance();
			if($_GET)
			{
				$idArt = $_GET['ar'];
				
			}
			if($_POST && ($_POST['comtext'] != ''))
			{			
				$id_user = 1;
				$date = time();
				
				$page = getenv('HTTP_REFERER');
				$idArt = preg_replace('/(.*?)ar=([0-9]+)(.*?)/', '\\2', $page);
				$pos = strpos($page, '?');
				$url = substr($page, $pos);
				
				$comment = $mArticles->Add_Com($_POST['comtext'], $id_user, $date, $idArt);
			}

			$comment = $mArticles->GetCom($idArt);
			if($comment)
	 		{
		 		$this->all_comments['comments'] = $comment;
		 		$this->all_comments['pagination'] = $mArticles->Page_nav('comments', $idArt);
	 		}
		}
		
		protected function OnOutput() 
		{
        	$content = $this->View(BASEPATH.'/view/v_tableCom.php', $this->all_comments);
			echo $content;
    	}
	}
	$obAddCom = Add_Comment::Instance();
	