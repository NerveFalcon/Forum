<?php 
/**
 * Контроллер отвечающий за главную страницу и основные функции
 */
class MainController
{
	
	/**
	 * Представление главной страницы
	 * @return bool true если представление успешно загружено\
	 * false если представление не загружено
	 */
	public static function actionIndex()
	{
		Router::View("/source/views/Main/main.php");
		return true;
	}

}
?>