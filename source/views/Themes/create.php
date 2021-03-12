<section id="createTopic">
	<div class="warning">
		<ul id="createErrors"></ul>
	</div>
	<form id="createForm" action="/createTheme" method="post">
		<fieldset>
			<legend>Создание темы</legend>
			<div>
				<div class="fontmin Tleft">
					<a class="user" href="/user/<?php echo $_SESSION['id'] ?>">
						<fromphp><?php echo $_SESSION['login'] ?></fromphp>
					</a>
					<span>
						<fromphp><?php echo date("Y-m-d H:i:s") ?></fromphp>
					</span>
				</div>
				<div>
					<input width="80pt" required type="text" name="title" id="topicTitle" placeholder="Заголовок">
				</div>
				<div>
					<textarea required name="description" id="topicDescription" cols="80" rows="10" placeholder="Описание темы, не больше 256 символов"></textarea>
				</div>
				<div class="Tcenter">
					<input type="reset" value="Сбросить">
					<input type="submit" value="Создать тему">
				</div>
			</div>
		</fieldset>
	</form>
	<script defer src="/source/resources/js/themes.js"></script>
</section>