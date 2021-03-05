<?php 
/**
 * Контроллер отвечающий за главную страницу и основные функции
 */
class MainController
{
	/**
	 * Представление главной страницы
	 */
	public static function actionIndex()
	{
		require_once(ROOT."/source/views/Main/main.php");
		return true;
	}

	/**
	 * Ошибка 404
	 */
	public static function actionError()
	{
		require_once(ROOT."/source/views/Main/404.php");
		return true;
	}
}
?>