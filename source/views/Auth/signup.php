<?php 
echo '<pre>POST ';
print_r($_POST);
echo '</pre>';
?>
<div class="auth">
    <div style="color: red; font-size: 14px; padding: 20px; margin: 0 auto; display: block; width:400px;">
        <?php if (isset($err) && is_array($err)): ?>
            <ul>
                <?php foreach ($err as $er): ?>
                    <li> - <?php echo $er; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
	<div class="registration" id="registration">
		<form action="" method="post">
			<fieldset>
				<legend>Регистрация</legend>
				<div class="changeForm">
					<a href="/auth">Авторизоваться</a>
				</div>
				<table class="Atable">
					<tr>
						<td>Логин</td>
						<td><input type="text" id="reg" name="login" required></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="text" id="reg" name="email" required></td>
					</tr>
					<tr>
						<td>Пароль</td>
						<td><input type="password" id="reg" name="password" required></td>
					</tr>
					<tr>
						<td>Повторите пароль</td>
						<td><input type="password" id="reg" name="repassword" required></td>
					</tr>
					<tr>
						<td><input class="pointer " type="reset" value="Сбросить" name="regreset" id="reg"></td>
						<td><input class="pointer " type="submit" value="Отправить" name="reg" id="reg"></td>
					</tr>
				</table>
			</fieldset>
		</form>
	</div>
</div>
