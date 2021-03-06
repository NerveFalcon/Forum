<section class="themes">
<!-- <div>
	<h2><a href="/theme/1"><fromphp>Правила форума</fromphp></a></h2>
	<p>Кратко о теме</p>
	<a href="/theme/1">Подробнее</a>
</div> -->
<?php foreach ($params[0] as $themeList => $value): 
	// if($value['id'] == 1) continue; ?>
<div>
	<h2><a href="/theme/<?php echo $value['id'];?>"><fromphp><?php echo $value['title'];?></fromphp></a></h2>
	<p><fromphp><?php echo $value['desc']; ?></fromphp></p>
	<a href="/theme/<?php echo $value['id'];?>">Подробнее</a>
</div>
<?php endforeach;?>
<div class="pg-btn flex-container-row flex-center">
<?php for ($i=0; $i < $params[1]; $i++):?>
<a href="/themes/<?php echo $i+1;?>" class="flex-item-row"><fromphp><?php echo $i+1;?></fromphp></a>
<?php endfor;?>
</div>
</section>
