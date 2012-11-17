<div id="artName">
	<h1><?=$title?></h1>	
</div>
<? if (!$review): ?>
    <div id="artText">
        <?=$about_text ?>
    </div>
<? endif;?>
<? if ($cast): ?>
	<div id="agree" onClick="javascript:showForm(); return false;">Я согласен(-а) с правилами клана и готов(-а) заполнить форму вступления в клан.</div>
    <div id="castField">
		<? require_once(BASEPATH.'/view/v_agree.php')?>
    </div>
<? endif;?>
<? if ($review): ?>
<div id="revHelp">
    <div id="reviewInf">
        <label style="color:#9C3;"><strong>Введите ваше имя:</strong></label><br>
        <input id="revN" type="text" maxlength="30">&nbsp;&nbsp;<span id="reviewName" style="color:#F00; font-weight:bold;"></span><br><br>
        <label style="color:#9C3;"><strong>Введите ваш E-mail:</strong></label><br>
        <input id="revE" type="text" maxlength="30">&nbsp;&nbsp;<span id="reviewMail" style="color:#F00; font-weight:bold;"></span><br><br>
        <span id="newCapt"><img src="<?=$captcha?>"></span><br><br>
        <input id="revCap" type="text" maxlength="5">&nbsp;&nbsp;<span id="captcha" style="color:#F00; font-weight:bold;"></span>
    </div>
        <? require_once(BASEPATH.'/view/v_comments.php')?>
</div>
<? endif;?>