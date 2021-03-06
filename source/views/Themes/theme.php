<?php #region describe ?>
<?php #endregion
	foreach ($params as $num => $content):
?>
	<div>
		<h4>Комментарий 
			<fromphp>
				<?php echo $content['author'] ?>
			</fromphp>
		</h4>
		<h4>Опубликовано: 
			<fromphp>
				<?php echo $content['date'] ?>
			</fromphp>
		</h4>
		<p>
			<fromphp>
				<?php echo $content['text'] ?>
			</fromphp>
		</p>
	</div>
<?php endforeach?>
<div class="Tright">
	<a href="../themes">Вернуться к темам</a>
</div>
