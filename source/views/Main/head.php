<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="/source/resources/css/style.css">
	<link rel="stylesheet" href="/source/resources/css/auth.css">
	<title>My forum</title>
	<script defer src="/source/resources/js/jQuery.js"></script>
	<script defer src="/source/resources/js/script.js"></script>
</head>

<body>
	<header class="flex-container-row flex-between">
		<div class="logo flex-item-row flex-item-row-first">
		</div>
		<div class="flex-item-row flex-grow2 flex-container-row flex-center">
			<a class="flex-item-row" href="/">Главная</a>
			<a class="flex-item-row" href="/themes">Темы</a>
			<a class="flex-item-row" href="/search">Поиск</a>
			<a class="flex-item-row" href="/create">Создать тему</a>
		</div>
		<div class="flex-item-row flex-item-row-last">
			<?php if (isset($_SESSION['login']))
			{ ?>
				<div id="headerAuth">
					Приветствую, 
					<a href="/lk" class="pointer">
						<fromphp><?php echo $_SESSION['login'] ?></fromphp>
					</a>
					<br>
					<button disabled class="pointer" id="logout">Выход</button>
				</div>
			<?php }
			else
			{ ?>
				<a href="/auth" class="auth-btn">Регистрация/Авторизация</a>
			<?php } ?>
		</div>
	</header>
	<div id="wrapper" class="flex-container-column flex-between">
		<main>