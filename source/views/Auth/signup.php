<section class="auth">
    <div class="warning">
		<ul id="authErrors"></ul>
    </div>
	<div>
		<form id="regForm" action="" method="post">
			<fieldset>
				<legend>Регистрация</legend>
				<div class="changeForm">
					<a href="/auth">Авторизоваться</a>
				</div>
				<table class="Atable">
					<tr>
						<td>Логин</td>
						<td><input type="text" id="login" required placeholder="a-zA-Z0-9"></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="text" id="email" required placeholder="yourname@example.com"></td>
					</tr>
					<tr>
						<td>Пароль</td>
						<td><input type="password" id="password" required placeholder="6 ~ 16 символов"></td>
					</tr>
					<tr>
						<td>Повторите пароль</td>
						<td><input type="password" id="repassword" required placeholder="6 ~ 16 символов"></td>
					</tr>
					<tr>
						<td><input class="pointer " type="reset" value="Сбросить" name="regreset" id="reg"></td>
						<td><input class="pointer " type="submit" value="Отправить" name="reg" id="reg"></td>
					</tr>
				</table>
			</fieldset>
		</form>
	</div>
	<script defer src="/source/resources/js/auth.js"></script>
</section>
