<?php
function Login($login, $remember){
	if($login == '')
		return false;

	$_SESSION['login'] = $login;

	if($remember)
		setcookie("login", $login, time() + 3600 * 24 * 7);
	
	return true;
}

function Logout()
{
	setcookie("login", '', time() - 1);
	unset($_SESSION);
}

session_start();
$enter_site = false;

Logout();

if(count($_POST) > 0)
	$enter_site = Login($_POST['login'], $_POST['remember'] == 'on');

if($enter_site)
{
	header("Location: a.php");
	exit();
}
?>

<html></html>
<?php 
/*******************************************************************************************************************************/
if(!isset($_SESSION['login']) && isset($_COOKIE['login']))
	$_SESSION['login'] = $_COOKIE['login'];

$login = $_SESSION['login'];

if($login == null)
{
	header("Location: login.php");
	exit;
}
?>