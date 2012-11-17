<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?=$title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="/css/style1.css">
<link rel="stylesheet" type="text/css" href="/css/MyPost.css">
<link rel="stylesheet" type="text/css" href="/css/menu.css">
<link rel="stylesheet" type="text/css" href="/css/paginator.css">
<link rel="stylesheet" type="text/css" href="/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<?php
	$brauser=$_SERVER['HTTP_USER_AGENT'];
	if (stristr($brauser,"Chrome"))
		echo '<link rel="stylesheet" type="text/css" href="/css/chrome.css">';
	elseif (stristr($brauser,"Opera")) 
		echo '<link rel="stylesheet" type="text/css" href="/css/opera.css">';
?>
<script type="text/javascript" src="/js/jQ.js"></script>
<script type="text/javascript" src="/js/comments.js"></script>
</head>

<body id="<?=$body?>">
		<div id="conteiner">
        		<div id="wraper">
        				<div id="top"></div><!--#top-->
                        
                        <div id="content">
                        		<div id="top_menu"><?  require_once(BASEPATH.'/view/v_menu.php'); ?></div><!--#top_menu-->
                                <?=$content;?>
                        </div><!--#content-->
                		<div id="right">
                        	<?=$right;?>
                        </div><!--#right-->
                </div><!--#wraper-->
                <div id="bottom"></div><!--#bottom-->
        </div><!--#conteiner-->
</body>
</html>