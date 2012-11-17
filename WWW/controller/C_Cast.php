<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(BASEPATH.'/base/C_Base.php');
require_once(BASEPATH.'/model/M_Articles.php');
require_once(BASEPATH.'/model/M_Captcha.php');

class C_Cast extends C_Base
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
		$this->title = 'Вступить в клан "KV"';
		$this->body = 'cast';
        $mArticles = M_Articles::Instance();
		$mCaptcha = M_Captcha::Instance();
		$this->article = $mArticles->GetText(2);
		$this->article['captcha'] = $mCaptcha->captcha();
		$this->article['cast'] = true;	
    }

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput() {

        $this->content = $this->View('view/v_simpleText.php', $this->article);
        parent::OnOutput();
    }
}