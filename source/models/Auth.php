<?php
/**
 * Модель работы с пользовательскими данными
 */
class Auth
{

	#region Авторизация

	/**
	 * Проверка авторизационных данных
	 * @param string $login Логин пользователя
	 * @return array Возвращает массив ошибок\
	 * пустой массив, если проверка пройдена
	 */
	public static function checkAuth(string $login, string $pass)
	{
		$err = Auth::checkValidLoginPasword($login, $pass);

		if (empty($err))
		{
			if (!Auth::isTruePassword($login, $pass))
			{
				$err[0] = "неверное сочетание логина/пароля";
			}
		}

		return $err;
	}

	/**
	 * Проверка совпадения логина/пароля
	 * @param string $login Логин пользователя
	 * @param string $pass Пароль пользователя
	 * @return bool true если сочетание логина и пароля совпадает\
	 * false если логин не найден, или сочетание логина и пароля не совпало
	 */
	public static function isTruePassword(string $login, string $pass)
	{
		$pass = hash("sha256", trim($pass));

		$db = Inquiry::getConnection();
		$query = $db->query("select password from users where ( login = '$login' )");
		$query = $query->fetch_all(1);
		$db->close();

		if (empty($query))
		{
			return false;
		}
		else if ($pass == $query[0]['password'])
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Получение идентификатора пользователя по логину
	 * @param string $login Логин пользователя
	 * @return int Идентификатор
	 */
	public static function getIdByLogin(string $login)
	{
		$db = Inquiry::getConnection();
		$query = $db->query("select id from users where login = '$login';");
		$db->close();

		return $query->fetch_all(1)[0]['id'];
	}

	#endregion

	#region Регистрация

	/**
	 * Проверка регистрационных данных
	 * @param string $login Логин пользователя
	 * @param string $email Электронная почта
	 * @param string $pass Пароль пользователя
	 * @param string $repass Повтор пароля
	 * @return array Возвращает массив ошибок\
	 * пустой массив, если проверка пройдена
	 */
	public static function checkReg(string $login, string $email, string $pass, string $repass)
	{
		$err = Auth::checkValidLoginPasword($login, $pass);

		if (empty($err))
		{
			if (!preg_match("/\w{3,}@\w{2,}\.\w{2,}/", $email))
			{
				$err[0] = "Невозможный адрес электронной почты";
			}
			else if (Auth::findLogin($login))
			{
				$err[0] = "Пользователь с таким логином уже существует";
			}
			else if (Auth::findMail($email))
			{
				$err[0] = "Пользователь с такой почтой уже существует";
			}
			else  if ($pass != $repass)
			{
				$err[0] = "Введенные пароли не совпадают";
			}
		}
		return $err;
	}

	/**
	 * Регистрация пользователя
	 * @param string $login Логин пользователя
	 * @param string $pass Пароль пользователя
	 * @param string $email Электронная почта пользователя
	 * @return array Возвращает массив ошибок\
	 * пустой массив, если проверка пройдена
	 */
	public static function setReg(string $login, string $pass, string $email)
	{
		$pass = hash("sha256", trim($pass));

		$db = Inquiry::getConnection();
		$query = $db->query("insert into users(login, password, email) values ('$login', '$pass', '$email')");
		$db->close();

		return $query;
	}

	#endregion

	#region Вспомогательные функции

	/**
	 * Проверка валидности логина и пароля
	 * @param string $login Логин пользователя
	 * @param string $pass Пароль пользователя
	 * @return array Возвращает массив ошибок\
	 * пустой массив, если проверка пройдена
	 * 
	 * Массив с ошибками, при нахождении оных
	 */
	public static function checkValidLoginPasword(string $login, string $pass)
	{
		$err = array();
		if (!preg_match("/[a-zA-Z0-9]+/", $login))
		{
			$err[0] = "Логин может состоять только из букв английского алфавита и цифр";
		}
		else if (strlen($login) < 3 || strlen($login) > 16)
		{
			$err[0] = "Логин должен быть не меньше 3-х символов и не больше 16";
		}
		else if (strlen($pass) < 6 || strlen($pass) > 16)
		{
			$err[0] = "Пароль должен быть не менее 6 символов и не больше 16";
		}
		return $err;
	}

	/**
	 * Поиск зарегистрированного логина в БД
	 * @param string $login Логин, поиск по которому будет произведен
	 * @return bool true если найден, иначе false
	 */
	public static function findLogin(string $login)
	{
		$db = Inquiry::getConnection();
		$query = $db->query("select * from users where ( login = '$login' )")->num_rows;
		$db->close();

		if ($query > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Поиск зарегистрированной электронной почты в БД
	 * @param string $mail Электронная почта, поиск по которой будет произведен
	 * @return bool true если найдена, иначе false
	 */
	public static function findMail(string $mail)
	{
		$db = Inquiry::getConnection();
		$query = $db->query("select * from users where ( email = '$mail' )")->num_rows;
		$db->close();
		
		if ($query > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	#endregion

}
