<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(BASEPATH.'/base/C_Base.php');
require_once(BASEPATH.'/model/M_Articles.php');

class C_ArticleView extends C_Base
{
	private $article;                //Статья 
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
		$this->body = 'art';
        $mArticles = M_Articles::Instance();
		$mUser = M_Users::Instance();
		$this->article = $mArticles->Get($_GET['ar']);
		$comment = $mArticles->GetCom($_GET['ar']);
		$this->article['user'] = $this->user = $mUser->Get();
		
		if($comment)
		{
			$this->article['comments'] = $comment;
			$this->article['pagination'] = $mArticles->Page_nav('comments');
		}
    }

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput() {

        $this->content = $this->View('view/v_articleView.php', $this->article);
        parent::OnOutput();
    }
}