<?php 
/**
 * Модель работы с пользовательскими данными
 */
class Auth{
	/**
	 * Поиск зарегистрированного логина в БД
	 * @param string $login Логин, поиск по которому будет произведен
	 * @return bool true если найден, иначе false
	 */
	public static function findLogin(string $login)
	{
		$db = Inquiry::getConnection();
		$db->set_charset('utf-8');

		$query = $db->query("select * from users where ( login = '$login' )");
		$result = $query->num_rows;
		if($result > 0) 
			return true; 
		else 
			return false;
	}

	/**
	 * Поиск зарегистрированной электронной почты в БД
	 * @param string $mail Электронная почта, поиск по которой будет произведен
	 * @return bool true если найдена, иначе false
	 */
	public static function findMail(string $mail)
	{
		$db = Inquiry::getConnection();
		$db->set_charset('utf-8');

		$query = $db->query("select * from users where ( email = '$mail' )");
		$result = $query->num_rows;
		if($result > 0) 
			return true; 
		else 
			return false;
	}

	/**
	 * Авторизация пользователя
	 * @param string $login Логин пользователя
	 * @param string $passwd Пароль пользователя
	 * @return bool true если сочетание логина и пароля совпадает
	 */
	public static function getAuth(string $login, $passwd)
	{
		$db = Inquiry::getConnection();
		$db->set_charset('utf-8');

		$passwd = hash("sha256", trim($passwd));
		$query = $db->query("select password from users where ( login = '$login' )")->fetch_all(1);
		if($passwd == $query['password'])
			return true;
		else
			return false;
	}

	/**
	 * Регистрация пользователя
	 * @param string $login Логин пользователя
	 * @param string $passwd Пароль пользователя
	 * @param string $email Электронная почта пользователя
	 * @return bool true если регистрация успешна, иначе false
	 */
	public static function doReg(string $login, string $passwd, string $email)
	{
		$db = Inquiry::getConnection(); 
		$db->set_charset("utf-8");

		$passwd = hash("sha256", trim($passwd));
		$result = $db->query("insert into users(login, password, email) values ('$login', '$passwd', '$email')");

		return $result;
	}

	/**
	 * Проверка авторизационных данных
	 * @return bool|array(string) true если проверка пройдена, иначе массив ошибок
	 */
	public static function checkAuth()
	{
		$err = array();
		if(!preg_match("/[a-zA-Z0-9]+/", $_POST['login']))
		{
			$err[] = "Логин может состоять только из букв английского алфавита и цифр";
		} 
		else if(strlen($_POST['login']) < 3 || strlen($_POST['login']) > 16)
		{
			$err[] = "Логин должен быть не меньше 3-х символов и не больше 16";
		} 
		if(empty($err[0]))
			return true;
		else
			return $err;
	}

	/**
	 * Проверка регистраыионных данных
	 * @return bool|array(string) true если проверка пройдена, иначе массив ошибок
	 */
	public static function checkReg()
	{
		$err = array();
		if(!preg_match("/[a-zA-Z0-9]+/", $_POST['login']))
		{
			$err[] = "Логин может состоять только из букв английского алфавита и цифр";
		} 
		else if(strlen($_POST['login']) < 3 || strlen($_POST['login']) > 16)
		{
			$err[] = "Логин должен быть не меньше 3-х символов и не больше 16";
		} 
		else if(Auth::findLogin($_POST['login']))
		{
			$err[] = "Пользователь с таким логином уже существует";
		} 
		else if(Auth::findMail($_POST['email']))
		{
			$err[] = "Пользователь с такой почтой уже существует";
		}
		else if($_POST['password'] != $_POST['repassword'])
		{
			$err[] = "Введенные пароли не совпадают";
		}
		if(empty($err[0]))
			return true;
		else
			return $err;
	}

}
