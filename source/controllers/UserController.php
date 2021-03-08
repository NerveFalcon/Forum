<?php 
// include_once ROOT."/source/models/User.php"; 
/**
 * Контроллер отвечающий за представление личного кабинета пользователя
 */
class UserController
{

	public static function actionPerson()
	{
		Router::View("/source/views/User/personalarea.php");
		return true;
	}
	
}
?>