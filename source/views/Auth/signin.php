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
	<div class="authorization" id="authorization">
		<form action="" method="post">
			<fieldset>
				<legend>Авторизация</legend>
				<div class="changeForm">
					<a href="/reg">Зарегистрироваться</a>
				</div>
				<table class="Atable">
					<tr>
						<td>Логин</td>
						<td><input type="text" id="auth" name="login" required></td>
					</tr>
					<tr>
						<td>Пароль</td>
						<td><input type="password" id="auth" name="password" required></td>
					</tr>
					<tr>
						<td><input class="pointer" type="reset" value="Сбросить" id="auth" name="aureset"></td>
						<td><input class="pointer" type="submit" value="Отправить" id="auth" name="auth"></td>
					</tr>
				</table>
			</fieldset>
		</form>
	</div>
</div>
