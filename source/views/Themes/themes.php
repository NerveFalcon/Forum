<section id="themes">
	<?php foreach ($params[0] as $themeList => $value) : ?>
		<div class="theme">
			<h2>
				<a href="/theme/<?php echo $value['id']; ?>">
					<fromphp>
						<?php echo $value['title']; ?>
					</fromphp>
				</a>
			</h2>
			<p>
				<fromphp>
					<?php echo $value['desc']; ?>
				</fromphp>
			</p>
			<a href="/theme/<?php echo $value['id']; ?>">Подробнее</a>
		</div>
	<?php endforeach; ?>
	<?php echo Themes::buildPageBtnsContainer($params[1], $params[2]); ?>
</section>