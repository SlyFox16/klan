 <div class="photoAlb">
    <ul class="col3">
    	<? $i = 0; $r = 0;?>
    	<? foreach ($pictures as $value): ?>
        <? $i++; $r++; ?>
        <? if ($i == 1): ?>
        	<div style="float:left;">
        <? endif;?>
        <li>
        	<a rel="example2" href="/images/photoalbum/<?=$value?>">
				<img src="/images/photoalbum/small/<?=$value?>" />
			</a>
        </li>
        <? if ($i == 3 || $r == $num): ?>
        	</div><!--sdf-->
        <? endif;?>
        <? if ($i==3): ?>
        	<? $i = 0 ;?>
        <? endif; ?>
		<? endforeach; ?>
    </ul>
  </div>
  <?=$pagination;?>