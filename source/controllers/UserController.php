<?php
// include_once ROOT."/source/models/User.php"; 
/**
 * Контроллер отвечающий за представление личного кабинета пользователя
 * @todo Сделать кабинет пользователя и отображение страничек каждого пользователя
 */
class UserController
{

	/**
	 * Представление личного кабинета пользователя
	 * @link http://www.php.my/lk
	 */
	public static function actionPerson()
	{
		if (ini_get('display_errors') == 0)
		{
			Router::View("/source/views/Main/Temp.php");
		}
		else
		{
			Router::View("/source/views/User/personalarea.php");
		}
		return true;
	}

	/**
	 * Предстаавление общедоступной странички пользователя
	 * @link http://www.php.my/user/$id
	 */
	public static function actionUser(int $id)
	{
		if (ini_get('display_errors') == 0)
		{
			Router::View("/source/views/Main/Temp.php");
		}
		else
		{
			return false;
		}
	}
}
