<?php
include_once ROOT . "/source/models/Auth.php";
/**
 * Контроллер отвечающий за представление авторизации
 */
class AuthController
{

	/**
	 * Представление авторизации
	 * @link http://www.php.my/auth
	 * @return bool true если представление успешно загружено\
	 * false если представление не загружено
	 */
	public static function actionSignin()
	{
		if (isset($_SESSION['login']))
		{
			header("Location: /");
			return true;
		}
		if (Ajax::isAjax())
		{
			header('Content-Type: text/json; charset=utf-8');
			$login = trim($_POST['login']);
			$pass = trim($_POST['password']);
			$check = Auth::checkAuth($login, $pass);
			if (empty($check))
			{
				$_SESSION['login'] = $login;
				$_SESSION['id'] = Auth::getIdByLogin($login);
				$ok = "OK";
				if ($_POST['remember'])
				{
					setcookie("login", $login, time() + 3600 * 24 * 7);
				}
				echo json_encode($ok);
			}
			else
			{
				echo json_encode($check);
			}
			return true;
		}
		else
		{
			Router::View("/source/views/Auth/signin.php");
			return true;
		}
	}

	/**
	 * Представление регистрации
	 * @link http://www.php.my/reg
	 * @return bool true если представление успешно загружено\
	 * false если представление не загружено
	 */
	public static function actionSignup()
	{
		if (isset($_SESSION['login']))
		{
			header("Location: /");
			return true;
		}
		if (Ajax::isAjax())
		{
			header('Content-Type: text/json; charset=utf-8');
			$login = trim($_POST['login']);
			$pass = trim($_POST['password']);
			$repass = trim($_POST['repassword']);
			$email = trim($_POST['email']);
			$check = Auth::checkReg($login, $email, $pass, $repass);
			if (empty($check))
			{
				if (Auth::setReg($login, $pass, $email))
				{
					echo json_encode("OK");
				}
				else
				{
					echo json_encode('Error');
				}
			}
			else
			{
				echo json_encode($check);
			}
			return true;
		}
		else
		{
			Router::View("/source/views/Auth/signup.php");
			return true;
		}
	}

	/**
	 * Представление отображающееся при успешной регистрации\
	 * Доступно только при переходе со страницы регистрации
	 * @link http://www.php.my/done
	 * @return bool true если представление успешно загружено\
	 * false если представление не загружено
	 */
	public static function actionDone()
	{
		if ($_SERVER['HTTP_REFERER'] == 'http://php.my/reg')
		{
			Router::View("/source/views/Auth/done.php");
			return true;
		}
		else
		{
			return false;
		}
	}

	/** Ajax
	 * Ajax-метод выхода из учтной записи
	 * @return bool true если выход успешно произведен\
	 * false если пользователь не авторизован\ 
	 * или пытается подключиться не через Ajax-запрос
	 */
	public static function actionLogout()
	{
		if (!isset($_SESSION['login']))
		{
			return false;
		}
		if (Ajax::isAjax())
		{
			setcookie("login", '', time() - 1);
			session_unset();
			echo json_encode('OK');
			return true;
		}
		else
		{
			return false;
		}
	}
}
