<div style="padding-left:20px;">
	<span style="color:#FFF; font-size:24px;">Вы вошли как <?=$user;?>.</span><br>
    <a href="?c=login" style="color:#0CF; font-size:20px;">Выход</a>
    <? if ($role == 'ADMIN'): ?>
    	<ul id="admList">
        	<li><a href="?c=arList" class="AdmMenu">Список статей</a></li>
            <li><a href="#" class="AdmMenu">Кандидаты в клан</a></li>
            <li><a href="#" class="AdmMenu">Отзывы</a></li>
            <li><a href="#" class="AdmMenu">Добавить статью</a></li>
        </ul>
    <? endif; ?>
</div>