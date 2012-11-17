<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(BASEPATH.'/base/Controller.php');
require_once(BASEPATH.'/model/M_Users.php');

abstract class C_Base extends Controller
{
    protected $need_login;      // необходима авторизация
    protected $user;            // текущий пользователь 
	protected $body;            // указатель на активность меню
	protected $right;           // Правое меню 
	
    //
    // Конструктор.
    //
    function __construct() {
        $this->need_login = false;
		$this->user = '';
    }

  
    //
    // Виртуальный обработчик запроса.
    //
    protected function OnInput() {
		parent::OnInput();
            $mUser = M_Users::Instance();
			$mUser->ClearSessions();
            $this->user = $mUser->Get();
    }
	
		protected function OnOutput()
	{
		if ($this->user == '')
			$rightCon = $this->View('view/v_notAuth.php');
		else
			$rightCon = $this->View('view/v_user.php', array('user' => $this->user['login'], 'role' => $this->user['id_role']));

		$vars = array('title' => $this->title, 'content' => $this->content, 'body' => $this->body, 'right' => $rightCon);
		$page = $this->View(BASE_TMP, $vars);
		echo $page;
	}
}