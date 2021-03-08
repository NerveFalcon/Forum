<section id="themes">
<!-- <div>
	<h2><a href="/theme/1"><fromphp>Правила форума</fromphp></a></h2>
	<p>Кратко о теме</p>
	<a href="/theme/1">Подробнее</a>
</div> -->
<?php foreach ($params[0] as $themeList => $value): 
	// if($value['id'] == 1) continue; ?>
<div class="theme">
	<h2><a href="/theme/<?php echo $value['id'];?>"><fromphp><?php echo $value['title'];?></fromphp></a></h2>
	<p><fromphp><?php echo $value['desc']; ?></fromphp></p>
	<a href="/theme/<?php echo $value['id'];?>">Подробнее</a>
</div>
<?php endforeach;?>
<?php echo Themes::buildPageBtnsContainer($params[1], $params[2]); ?>
</section>
