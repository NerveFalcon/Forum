<?php 
/**
 * Контроллер отвечающий за главную страницу и основные функции
 */
class MainController
{
	
	/**
	 * Представление главной страницы
	 * @link http://www.php.my/
	 * @return bool true если представление успешно загружено\
	 * false если представление не загружено
	 */
	public static function actionIndex()
	{
		Router::View("/source/views/Main/main.php");
		return true;
	}

}
