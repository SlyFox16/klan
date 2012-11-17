<div id="artName">
	<h1><?=$name?></h1>	
</div>
<div id="artInf">
	Автор: <?=$author?><br>
    Дата: <?=$date?><br>
    Категория: <?=$cat_name?>
</div>
<div id="artText">
	<?=$content?>
</div>
	<div id="artCom">
    	<? require_once(BASEPATH.'/view/v_tableCom.php')?>
    </div>
    <? if ($user != ''): ?>
		<? require_once(BASEPATH.'/view/v_comments.php')?>
	<? endif;?>