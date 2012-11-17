<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(BASEPATH.'/base/C_Base.php');
require_once(BASEPATH.'/model/M_Articles.php');
require_once(BASEPATH.'/model/M_Captcha.php');

class C_Review extends C_Base
{
	private $article;             //Все статьи 
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
		$this->title = 'Отзыв о клане "KV"';
		$mCaptcha = M_Captcha::Instance();
		
		$this->body = 'review';
        $mArticles = M_Articles::Instance();
		$this->article = $mArticles->GetText(3);
		$this->article['review'] = true;
		$this->article['captcha'] = $mCaptcha->captcha();
    }

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput() {

        $this->content = $this->View('view/v_simpleText.php', $this->article);

        parent::OnOutput();
    }
}