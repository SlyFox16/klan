<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(BASEPATH.'/base/C_Base.php');
require_once(BASEPATH.'/model/M_Articles.php');

class C_About extends C_Base
{
	private $article;          //Статья 
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
		$this->title = 'О клане "KV"';
		$this->body = 'about';
        $mArticles = M_Articles::Instance();
		$this->article = $mArticles->GetText(1);
    }

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput() {

        $this->content = $this->View('view/v_simpleText.php', $this->article);
        parent::OnOutput();
    }
}