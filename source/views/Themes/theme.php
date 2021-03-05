<?php foreach ($themesItem as $num => $content):?>
<?php if($num == 0){?>
	<div>
		<h1><?php echo "<fromphp>${content['title']}</fromphp>";?></h1>
		<h3>Автор: <?php echo "<fromphp>${content['author']}</fromphp>"?></h3>
		<h3>Опубликовано: <?php echo "<fromphp>${content['date']}</fromphp>"?></h3>
		<p><?php echo "<fromphp>${content['text']}</fromphp>"?></p>
		<hr>
		<pr></pr>
	</div>
<?php }else{?>
	<div>
		<h4>Комментарий <?php echo "<fromphp>${content['author']}</fromphp>";?></h4>
		<h4>Опубликовано: <?php echo "<fromphp>${content['date']}</fromphp>"?></h4>
		<p><?php echo "<fromphp>${content['text']}</fromphp>"?></p>
	</div>
<?php } endforeach?>
<div class="Tright">
	<a href="../themes">Вернуться к темам</a>
</div>
