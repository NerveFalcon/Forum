<?php
session_start();

if (!isset($_SESSION['login']) 
	&& isset($_COOKIE['login']) 
	&& ($_COOKIE['login'] != null)
	)
{
	$_SESSION['login'] = $_COOKIE['login'];
}

// Month: 11, Day: 21, Year: 2021!
// $pattern = '/([0-9]{2})-([0-9]{2})-([0-9]{4})/';
// $replacement = "Month: $2, Day: $1, Year: $3!";

#	1. Общие настройки
ini_set("display_errors", 0);
error_reporting(E_ALL);

#	2. Подключение файлов системы
define("ROOT", dirname(__FILE__));
if (ini_get('display_errors') == 0)
{
	/** Релиз */
	define('ITEMS_ON_PAGE', 10);
}
else
{
	/** Отладка */
	define('ITEMS_ON_PAGE', 2);
}


require_once(ROOT . "/source/components/Router.php");
require_once(ROOT . "/source/components/Inquiry.php");
include_once(ROOT . "/source/components/Ajax.php");

Router::Run(include(ROOT . "/source/config/routes.php"));
