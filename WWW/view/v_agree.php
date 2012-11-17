<form>
	<table cellpadding="0" cellspacing="8">
    	<tr>
        	<td class="tableLabel"><label style="color:#F60;">Ник в игре:</label></td>
            <td class="tableCast"><input name="gameNick" type="text" maxlength="25"></td>
        </tr>
        <tr>
        	<td class="tableLabel"><label style="color:#F60;">E-mail:</label></td>
            <td class="tableCast"><input name="emaill" type="text"  maxlength="30" ></td>
        </tr>
        <tr>
        	<td class="tableLabel"><label style="color:#F60;">Имя:</label></td>
            <td class="tableCast"><input name="name" type="text" maxlength="25"></td>
        </tr>
        <tr>
        	<td class="tableLabel"><label style="color:#F60;">Возраст:</label></td>
            <td class="tableCast"><input style="width:23px;" name="age" type="text" maxlength="2" onkeyup="javascript:proverka(this); return false;"></td>
        </tr>
        <tr>
        	<td class="tableLabel"><label style="color:#F60;">Танки в наличии 9-10 уровня:<br>(артиллерия 7-8)</label></td>
            <td class="tableCast">    
            <textarea id="tanks" rows="7" name="tanks" wrap="virtual" onKeyDown="javascript:tanksClear(event.keyCode); return false;"></textarea>
                <select id="level9-10" onChange="javascript:selectTank(); return false;">
                    <option selected="selected" value="null">Список танков</option>
                    <option disabled="disabled" style="font-weight:bold; color:#00F; background-color:#CCC;">CCCP</option>
                    <option>ИС-4</option>
                    <option>ИС-7</option>
                    <option>T-44</option>
                    <option>T-54</option>
                    <option>ИСУ-152</option>
                    <option>Объект-704</option>
                    <option>Объект-212</option>
                    <option>Объект-261</option>
                    <option disabled="disabled" style="font-weight:bold; color:#00F; background-color:#CCC;">Германия</option>
                    <option>Тапок</option>
                    <option>E-75</option>
                    <option>E-100</option>
                    <option>Maus</option>
                    <option>Panther II</option>
                    <option>E-50</option>
                    <option>Ferdinand</option>
                    <option>Jagdtiger</option>
                    <option>GW Tiger</option>
                    <option>GW Typ E</option>
                    <option disabled="disabled" style="font-weight:bold; color:#00F; background-color:#CCC;">США</option>
                    <option>T 34</option>
                    <option>T 30</option>
                    <option>M26 Pershing</option>
                    <option>M46 Patton</option>
                    <option>T 28</option>
                    <option>T 95</option>
                    <option>M40/M43</option>
                    <option>T 92</option>
         		</select>
                <br>
                <input id="rem" type="button" value="отмена" style="margin-top:5px; border:1px #39302B solid;">
            </td>
        </tr>
        <tr>
        	<td class="tableLabel"><label style="color:#F60">Колличество проведённых боёв:</label></td>
            <td class="tableCast"><input name="games" type="text" maxlength="10" onkeyup="javascript:proverka(this); return false;"></td>
        </tr>
        <tr>
        	<td class="tableLabel"><label style="color:#F60">Когда вы бываете в игре?</label></td>
            <td class="tableCast">
            <table>
            <? $ar = array('Понедельник' => 'mon', 'Вторник' =>'tue', 'Среда' =>'wed', 'Четверг' =>'thu', 'Пятница' =>'fri', 'Суббота' =>'sat', 'Воскресенье' =>'sun');?>
            <? foreach ($ar as $key => $value): ?>
            	<tr>
            		<td>
            <input name="<?=$value?>" type="checkbox" value="1" onChange="javascript:able(this, '<?=$value.'Ch'?>', '<?=$value.'Ch2'?>'); return false;"> <label class="day"><?=$key?></label>
            		</td>
                    <td style="padding-left:5px;">
            										<label class="day">C&nbsp;</label><select id="<?=$value.'Ch'?>" name="<?=$value.'From'?>" disabled>
																		<? for($i = 0; $i < 24; $i++):?>
                                                                        	<? if($i < 10): ?>
                                                                        		<option><?='0'.$i ?>
                                                                            <? else: ?>
                                                                            	<option><?=$i ?>
                                                                            <? endif; ?>
                                                                        <? endfor; ?>
                                                    				</select>
                                                    <label class="day">До&nbsp;</label><select id="<?=$value.'Ch2'?>" name="<?=$value.'Till'?>" disabled>
																		<? for($i = 0; $i < 25; $i++):?>
                                                                        	<? if ($i < 10): ?>
                                                                        		<option><?='0'.$i ?>
                                                                            <? else: ?>
                                                                            	<option><?=$i ?>
                                                                            <? endif; ?>
                                                                        <? endfor; ?>
                                                    				</select>
                     </td>
                 </tr>
            <? endforeach; ?>
            </table>
            </td>
        </tr>
        <tr>
        	<td class="tableLabel"><label style="color:#F60">Как с вами связаться?</label></td>
            <td class="tableCast">
            <table>
            	<tr>
                	<td>
            <input type="checkbox" value="1" onChange="javascript:ableCon(this, 'icq'); return false;"> <label class="day">ICQ</label>
            		</td>
                    <td style="padding-left:5px;">  
            					  <input id="icq" name="ICQ" type="text" maxlength="12" onkeyup="javascript:proverka(this); return false;" disabled>
            		</td>
            	</tr>
                <tr>
                	<td>
            					  <input type="checkbox" value="1" onChange="javascript:ableCon(this, 'skype'); return false;"> <label class="day">SKYPE</label>  
                    </td>
                    <td style="padding-left:5px;">
                                  <input id="skype" name="SKYPE" maxlength="25" type="text" disabled>
                    </td>
            	</tr>
            </table>
            </td>
        </tr>
        <tr>
        	<td class="tableLabel" id="capImg"><img src="<?=$captcha;?>"></td>
            <td class="tableCast"><input id="captcha2" name="captcha" type="text" maxlength="5"></td>
        </tr>
        <tr>
        	<td  colspan="2" style="text-align:center;">
            	<div id="errorAns"></div>
         <input id="submit" type="submit" style="margin-top:5px; border:1px #39302B solid;" onClick="javascript:addCast(); return false;"></td>
            <td></td>
        </tr>
    </table>
</form>