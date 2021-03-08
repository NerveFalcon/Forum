<section id="topic">
<div class="theme">
	<span class="fontmin">
		<a class="user" href="/user/<?php echo $params[0]['id_creator'] ?>"><fromphp><?php echo $params[0]['author']?></fromphp></a>
		<span><fromphp><?php echo $params[0]['date']?></fromphp></span>
	</span>
	<h1><fromphp><?php echo $params[0]['title']?></fromphp></h1>
	<h5><fromphp><?php echo $params[0]['description']?></fromphp></h5>

	<hr>
</div>
<?php foreach ($params[2] as $num => $content):?>
	<div class="comment">
		<sub>
			<a class="user" href="/user/<?php echo $content['id_creator'] ?>">
				<fromphp>
					<?php echo $content['commentator'] ?>
				</fromphp>
			</a>
			<fromphp>
				<?php echo $content['date'] ?>
			</fromphp>
		</sub>
		<h4>
			<fromphp>
				<?php echo $content['text'] ?>
			</fromphp>
		</h4>
	</div>
<?php endforeach?>
<div class="Tright">
	<a href="../themes">Вернуться к темам</a>
</div>
</section>
