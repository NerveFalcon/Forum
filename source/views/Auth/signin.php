<section class="auth">
    <div class="warning">
        <ul id="authErrors"></ul>
    </div>
	<div>
		<form id="authForm" action="" method="post">
			<fieldset>
				<legend>Авторизация</legend>
				<div class="changeForm">
					<a href="/reg">Зарегистрироваться</a>
				</div>
				<table class="Atable">
					<tr>
						<td>Логин</td>
						<td><input type="text" id="login" required placeholder="a-zA-Z0-9"></td>
					</tr>
					<tr>
						<td>Пароль</td>
						<td><input type="password" id="password" required placeholder="6 ~ 16 символов"></td>
					</tr>
					<tr>
						<td><input class="pointer" type="reset" value="Сбросить" id="authReset"></td>
						<td><input class="pointer" type="submit" value="Отправить" id="authBtn"></td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="checkbox" id="remember">
							<label for="remember">Запомнить?</label>
						</td>
					</tr>
				</table>
			</fieldset>
		</form>
	</div>
	<script defer src="/source/resources/js/auth.js"></script>
</section>