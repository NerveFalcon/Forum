<input id="search" type="text" placeholder="Введите название темы">
<section class="themes">
<?php foreach ($params as $themeList => $value): 
	// if($value['id'] == 1) continue; ?>
<div>
	<h2><a href="/theme/<?php echo $value['id'];?>"><fromphp><?php echo $value['title'];?></fromphp></a></h2>
	<p><fromphp><?php echo $value['desc']; ?></fromphp></p>
	<a href="/theme/<?php echo $value['id'];?>">Подробнее</a>
</div>
<?php endforeach;?>
<script src="/source/resources/js/jQuery.js"></script>
<script src="/source/resources/js/search.js"></script>
</section>
