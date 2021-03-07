<?php
include_once ROOT."/source/models/Themes.php"; 
class ThemesController  
{
	/**
	 * Представление поиска по всем темам с постраничным выводом
	 * @return bool true если представление успешно загружено\
	 * false если представление не загружено
	 */
	public static function actionSearch()
	{
		if(Ajax::isAjax())
		{
			header('Content-Type: text/json; charset=utf-8');
			$list = Ajax::getSearchList($_POST['search']);
			echo json_encode($list);
			return true;
		} 
		else
		{
			$activeThemes = Themes::getActiveThemesPage(0, 10);
			Router::View("/source/views/Themes/search.php", $activeThemes);
			return true;
		}
	}
	
	/**
	 * Представление всех тем с постраничным выводом
	 * @param int $page Номер страницы
	 * @param int $count Количество тем на странице
	 * @return bool true если представление успешно загружено\
	 * false если представление не загружено
	 */
	public static function actionThemes(int $page = 1, int $count = 10)
	{
		$page = ($page < 1) ? 0 : $page - 1;
		$themesCount = Themes::getActiveThemesCount();
		if($themesCount >= ($page*$count))
		{
			if($themesCount < $count)
			{
				return false;
			}
			$Pcount = $themesCount / $count;
			$activeThemes = Themes::getActiveThemesPage($page*$count, $count);
			Router::View("/source/views/Themes/themes.php", [$activeThemes, $Pcount, $page+1]);
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Представление конкретной темы
	 * @param int $id Идентификатор конкретной темы
	 * @param int $page Номер страницы
	 * @param int $count Количество тем на странице
	 * @return bool true если представление успешно загружено\
	 * false если представление не загружено
	 */
	public static function actionMsg(int $id, int $page = 1, int $count = 10)
	{
		if(( $id >= 0 ) && ( $id <= Themes::getAllThemesCount() ))
		{
			$page = ($page < 1) ? 0 : $page - 1;
			$msgCount = Themes::getMsgCount($id);
			if($msgCount < $count)
			{
				$Pcount = $msgCount;
			}
			else
			{
				$Pcount = $msgCount / $count;
			}
			$msgList = Themes::getMsgByThemeId($id, $page*$count, $count);
			$themeItem = Themes::getThemeById($id);
			Router::View("/source/views/Themes/theme.php", [$themeItem, $Pcount, $msgList]);
			return true;
		}
		else
		{
			return false;
		}
	}
}

?>