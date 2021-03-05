<section class="themes">
<!-- <div>
	<h2><a href="/theme/1"><fromphp>Правила форума</fromphp></a></h2>
	<p>Кратко о теме</p>
	<a href="/theme/1">Подробнее</a>
</div> -->
<?php foreach ($themesList as $themeList => $value): 
	// if($value['id'] == 1) continue; ?>
<div>
	<h2><a href="/theme/<?php echo $value['id'];?>"><?php echo "<fromphp>${value['title']}</fromphp>";?></a></h2>
	<p>Кратко о теме</p>
	<a href="/theme/<?php echo $value['id'];?>">Подробнее</a>
</div>
<?php endforeach;?>
<div class="pg-btn flex-container flex-center">
<?php for ($i=0; $i < $Pcount; $i++):?>
<a href="/themes/<?php echo $i+1;?>" class="flex-item"><fromphp><?php echo $i+1;?></fromphp></a>
<?php endfor;?>
</div>
</section>
