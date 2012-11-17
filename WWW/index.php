<?php
require_once('base/startup.php');

switch ($_GET['c'])
{
case 'photo':
	require_once('controller/C_Photoalbum.php');
	$controller = new C_Photoalbum();
	break;
case 'cast':
	require_once('controller/C_Cast.php');
	$controller = new C_Cast();
	break;
case 'about':
	require_once('controller/C_About.php');
	$controller = new C_About();
	break;
case 'view':
	require_once('controller/C_ArticleView.php');
	$controller = new C_ArticleView();
	break;
case 'review':
	require_once('controller/C_Review.php');
	$controller = new C_Review();
	break;
case 'login':
	require_once('controller/C_Login.php');
	$controller = new C_Login();
	break;
case 'arList':
	require_once('controller/admin/C_ArticlesList.php');
	$controller = new C_ArticlesList();
	break;
/*case ($_POST['login'] && $_POST['password']):
	require_once('controller/C_Login.php');
	$controller = new C_Login();
	break;*/
default:
	require_once('controller/C_ArticlesView.php');
	$controller = new C_ArticlesView();
}

$controller->Request();