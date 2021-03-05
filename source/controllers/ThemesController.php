<?php
include_once ROOT."/source/models/Themes.php"; 
class ThemesController  
{
	/**
	 * Представление всех тем с постраничным выводом
	 */
	public static function actionThemes($page = 1, $count = 10)
	{
		($page < 1) ? $page = 0 : --$page;
		$Tcount = Themes::getThemesCount();
		if($Tcount >= ($page*$count))
		{
			$Pcount = $Tcount / $count;
			$themesList = Themes::getThemesList($page*$count, $count);
			$desc = Themes::getThemesMsg(1);
			// echo '<pre>';
			// print_r($themesList);
			// print_r($desc);
			// echo '</pre>';
			require_once(ROOT."/source/views/Themes/themes.php");
			return true;
		}
		else
		{
			require_once(ROOT."/source/views/Main/404.php");
		}
	}

	/**
	 * Представление конкретной темы
	 */
	public static function actionMsg($id)
	{
		if ($id) 
		{
			$themesItem = Themes::getThemesItemById($id);
			require_once(ROOT."/source/views/Themes/theme.php");
		}
		else
		{
			MainController::actionError();
		}
	}
}

?>