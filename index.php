<?php session_start();
#region settings
#region format date
// $string = '21-11-241';

// Month: 11, Day: 21, Year: 2021!

// $pattern = '/([0-9]{2})-([0-9]{2})-([0-9]{4})/';
// $replacement = "Month: $2, Day: $1, Year: $3!";

#endregion
#	1. Общие настройки
ini_set("display_errors", 1);
error_reporting(E_ALL);

#	2. Подключение файлов системы
define("ROOT", dirname(__FILE__));
require_once(ROOT."/source/components/Router.php");
require_once(ROOT."/source/components/Inquiry.php");
#endregion
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="/source/resources/css/style.css">
	<link rel="stylesheet" href="/source/resources/css/auth.css">
	<link rel="stylesheet" href="/source/models/main.css">
	<title>My forum</title>
</head>
<body>
	<header class="flex-container flex-between">
		<div class="logo flex-item flex-item-first">
		</div>
		<div class="flex-item flex-grow2 flex-container flex-center">
			<a class="flex-item" href="/">Главная</a>
			<a class="flex-item" href="/themes">Темы</a>
			<!-- <a class="flex-item" href="/products">Продукты</a> -->
		</div>
		<div class="flex-item flex-item-last">
			<a href="/auth" class="auth-btn">Регистрация/Авторизация</a>
		</div>
	</header>
	<main>
		<?php 
		#region	Вызов Router
		$router = new Router();
		$router->run();
		#endregion
		?>
	</main>
	<footer>
	</footer>
</body>
</html>