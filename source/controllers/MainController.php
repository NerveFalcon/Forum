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
		Router::View("/source/views/Main/main.php");
		return true;
	}

}
?>