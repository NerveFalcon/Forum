<?php session_start();
// Month: 11, Day: 21, Year: 2021!
// $pattern = '/([0-9]{2})-([0-9]{2})-([0-9]{4})/';
// $replacement = "Month: $2, Day: $1, Year: $3!";

#	1. Общие настройки
ini_set("display_errors", 1);
error_reporting(E_ALL);

#	2. Подключение файлов системы
define("ROOT", dirname(__FILE__));
require_once(ROOT."/source/components/Router.php");
require_once(ROOT."/source/components/Inquiry.php");
include_once(ROOT."/source/components/Ajax.php");

$router = new Router();
$router->run();
?>