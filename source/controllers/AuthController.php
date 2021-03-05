<?php 
include_once ROOT."/source/models/Auth.php"; 
/**
 * Контроллер отвечающий за функции авторизации
 */
class AuthController
{
	/**
	 * Представление авторизации
	 * @param array $err Массив ошибок предыдущих попыток
	 */
	public static function actionSignin(array $err = array())
	{
		require_once(ROOT."/source/views/Auth/signin.php");
	}

	/**
	 * Представление регистрации
	 */
	public static function actionSignup(array $err = array())
	{
		require_once(ROOT."/source/views/Auth/signup.php");
	}

	/**
	 * Проверка пользовательских данных
	 */
	public static function actionIndex()
	{
		if(isset($_POST['reg']))
		{
		#region registration
			$passwd = $_POST['password'];
			$email = $_POST['email'];
			Auth::checkReg();
			
			if(Auth::doReg($_POST['login'], $passwd, $email))
			{
				require_once(ROOT."/source/views/Auth/done.php");
			}
			else
			{
				$err[] = "Неудачная регистрация";
			}
		#endregion
		}
		else
		{
		#region authorization
			if(isset($_POST['auth']))
			{
				if(Auth::getAuth($_POST['login'], $_POST['password']))
				{
					require_once(ROOT."/source/views/Auth/done.php");
				}
				else
				{
					echo "Вы ввели неправильный логин/пароль";
				}
			}
			else
			{
				MainController::actionError();
			}
		#endregion
		}
	}
}
