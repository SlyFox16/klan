<div id="comment">
	<noscript>
    	<br>
    	<font style="color:#fff; font-size:24px;"><strong>Без включённого javascript Вы не сможете добавлять комментарии</strong></font>
        </br>
        </br>
        </br>
    </noscript>
	<label style="color:#9C3;"><strong>Ваш комментарий:</strong></label><br>
    <label style="color:#F00;"><strong>*При загрузке картинок копируйте ссылку с надписью "Превью-увеличение по клику (BBcode)"</strong></label><br>
	<div id="buttons">
    	<input value=" [ link ] " title="ссылка" type="Button" onclick="javascript:fnPrompt(); return false;">
        <input value=" [ B ] " title="жирный" type="Button" onclick="javascript:fnApplyTag('bold'); return false;" style="font-weight: bold;">
        <input value=" [ цитата ] " title="цитата" type="Button" onclick="javascript:fnApplyTag('quote'); return false;">
        <input value=" [ em ] " title="курсив" type="Button" onclick="javascript:fnApplyTag('italic'); return false;" style="font-style: italic;"> 
        <select id="mySelectId" class="text_color" name="codeColor" onChange="javascript:selectFn('mySelectId', true); return false;">
            <option selected="selected" value="black" style="color: black; background: #fff;">Чёрный</option>
            <option value="darkred" style="color: darkred;">&nbsp;Тёмно-красный</option>
            <option value="brown" style="color: brown;">&nbsp;Коричневый</option>
            <option value="#996600" style="color: #996600;">&nbsp;Оранжевый</option>
            <option value="red" style="color: red;">&nbsp;Красный</option>
            <option value="#993399" style="color: #993399;">&nbsp;Фиолетовый</option>
            <option value="green" style="color: green;">&nbsp;Зелёный</option>
            <option value="darkgreen" style="color: darkgreen;">&nbsp;Тёмно-Зелёный</option>
            <option value="gray" style="color: gray;">&nbsp;Серый</option>
            <option value="olive" style="color: olive;">&nbsp;Оливковый</option>
            <option value="blue" style="color: blue;">&nbsp;Синий</option>
            <option value="darkblue" style="color: darkblue;">&nbsp;Тёмно-синий</option>
            <option value="indigo" style="color: indigo;">&nbsp;Индиго</option>
            <option value="#006699" style="color: #006699;">&nbsp;Тёмно-Голубой</option>
         </select>
         
         <select id="myFontSelectId" class="text_size" name="codeSize" onChange="javascript:selectFn('myFontSelectId', false); return false;">
            <option selected="selected" value="12">Размер:</option>
            <option class="em" value="9">Маленький</option>
            <option value="10">&nbsp;size=10</option>
            <option value="11">&nbsp;size=11</option>
            <option class="em" disabled="disabled" value="12">Обычный</option>
            <option value="14">&nbsp;size=14</option>
            <option value="16">&nbsp;size=16</option>
            <option class="em" value="18">Большой</option>
            <option value="20">&nbsp;size=20</option>
            <option value="22">&nbsp;size=22</option>
            <option class="em" value="24">Огромный</option>
         </select>
         <input value=" [ img ] " title="Вставить картинку" type="Button" onclick="window.open('http://upyourpic.org/','_blank');"> 
	</div>
    <div id="smiles">
    	<?
		$dir = BASEPATH."/images/smiles";
      	$data = opendir($dir);
		while (false !== ($file = readdir($data)))
		{
			 if ($file != "." && $file != ".." && file_exists($dir.'/'.$file))
			 {
				 if(preg_match('/\.jpg|\.png|\.gif$/i', $file))
					$smiles[] = "<img src=\"/images/smiles/".$file."\">";
        	 }
		}
		$_SESSION['emoticons'] = $smiles;
        foreach ($smiles as $key => $value) 
		{
        	echo "<a href=\"javascript:show('[{$key}]')\">$value</a>";
        }
	  ?>
    </div>
	<form method='post' action="/helpers/addComment.php">
<textarea id="f1" rows="7" wrap="physical" onKeyUp="javascript:check(); return false;" /></textarea><br>
<div id="buttons2">
	<input id="sm" type="button" value="Смайлы" onClick="javascript:showSmiles(); return false;" />
    <input id="submit" type="button" value="Добавить" name="submit" disabled onclick="javascript:<? if ($review) echo 'addReview();'; else echo 'addCom();'?> return false;"/>
    <input id="reset" type="reset" value="Очистить" name="reset" disabled onclick="javascript:resetf(); return false;" />
</div>
</form>
</div>