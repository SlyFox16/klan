<? if($comments): ?>
	<? $i=0; ?>
        	<table cellpadding="0" cellspacing="0" style="border-collapse:collapse">
                <? foreach($comments as $value): ?>
                	<? 
						if($i%2 == 0){
							$color = '#E0EEEE';
						} else {
							$color = '#C1CDCD';
						}
						$i++;
					?>
                	<tr style="background-color:<?=$color?>;">
                    	<td class="ava" rowspan="2"><img src="/images/avatars/SlyFox1.jpg"><br><span><?=$value['login']?></span></td>
                        <td class="date"><?=$value['date']?></td>
                    </tr>
                    <tr style="background-color:<?=$color?>;">
                        <td class="soob"><?=$value['comment']?></td>
                    </tr>
                <? endforeach; ?>
        	</table>
<? endif; ?>
<?=$pagination?>