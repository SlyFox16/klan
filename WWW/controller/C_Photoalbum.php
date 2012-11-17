<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(BASEPATH.'/base/C_Base.php');
require_once(BASEPATH.'/model/M_Photo.php');

class C_Photoalbum extends C_Base
{     
	private $photoes;    
    //
    // Конструктор.
    //
    function __construct() 
	{
		parent::__construct();
    }

    //
    // Виртуальный обработчик запроса.
    //
    protected function OnInput() 
	{
        parent::OnInput();
		$this->title = 'Фотоальбом клана "KV"';
		$mPhoto = M_Photo::Instance();
		
		$this->body = 'album';
		$dir = BASEPATH."/images/photoalbum/small";
      	$data = opendir($dir);
		while (false !== ($file = readdir($data)))
		{
			 if ($file != "." && $file != ".." && file_exists($dir.'/'.$file))
			 {
				 if(preg_match('/\.jpg|\.png|\.gif$/i', $file))
					$photo[] = $file;
        	 }
		}
		$_SESSION['photos'] = $photo;
		
		$Phtos = $mPhoto->getPhotos($_GET['page']);
		$this->photoes['pictures'] = $Phtos;
		//$this->photoes['num'] = count($Phtos);
		$this->photoes['pagination'] = $mPhoto->Page_nav();
    }

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput() {

        $this->content = $this->View('view/v_photoes.php', $this->photoes);

        parent::OnOutput();
    }
}