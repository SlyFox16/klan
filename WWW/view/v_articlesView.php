<? foreach ($list as $value):?>
<div class="post">
    		<div class="head">
            		<span class="comments" title="комментарии"><?=$value['comments']?></span>
            		<span class="date"><strong><?=$value['month']?></strong><span><?=$value['day']?></span><small><?=$value['year']?></small></span>
                    <h2><a href="?c=view&ar=<?=$value['id_article']?>"><?=$value['name']?>

</a></h2>
            </div> 
            <div class="inf">
            		 <p>
                        <span>Категория: <a href="#"><?=$value['cat_name']?></a></span>
                        Автор: <a href="#"><?=$value['author']?></a>&nbsp;&nbsp;&nbsp;&nbsp;Просмотров: <?=$value['views']?>  
                    </p>
            </div>

         <div class="art"><?=$value['description']?></div>
</div>
<? endforeach;?>
<?=$pagination;?>