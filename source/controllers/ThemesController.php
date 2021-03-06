<?php
include_once ROOT."/source/models/Themes.php"; 
class ThemesController  
{
	/**
	 * Представление поиска по всем темам с постраничным выводом
	 * @param string $search поисковый запрос
	 * @param int $page Номер страницы
	 * @param int $count Количество тем на странице
	 */
	public static function actionSearch()
	{
		if(Ajax::isAjax())
		{
			$list = Ajax::getSearchList($_POST['search']);
			header('Content-Type: text/json; charset=utf-8');
			echo json_encode($list);
			return true;
		}
		else
		{
			$themesList = Themes::getThemesList(0, 10);
			Router::View("/source/views/Themes/search.php", $themesList);
			return true;
		}
	}
	
	/**
	 * Представление всех тем с постраничным выводом
	 * @param int $page Номер страницы
	 * @param int $count Количество тем на странице
	 */
	public static function actionThemes(int $page = 1, int $count = 10)
	{
		$page = ($page < 1) ? 0 : $page - 1;
		$Tcount = Themes::getThemesCount();
		if($Tcount >= ($page*$count))
		{
			$Pcount = $Tcount / $count;
			if($Tcount < $count)
				return false;
			$themesList = Themes::getThemesList($page*$count, $count);
			Router::View("/source/views/Themes/themes.php", [$themesList, $Pcount]);
			return true;
		}
		else
			return false;
	}

	/**
	 * Представление конкретной темы
	 * @param int $id Идентификатор конкретной темы
	 */
	public static function actionMsg(int $id, int $page = 1, int $count = 10)
	{
		if( ($id >= 0) && ($id < Themes::getThemesCount()))
		{
			$page = ($page < 1) ? 0 : $page - 1;
			$Tcount = Themes::getThemesCount();
			if($Tcount >= ($page*$count))
			{
				$Pcount = $Tcount / $count;
				if($Tcount < $count)
					return false;
				$msgList = Themes::getMsgList($id, $page*$count, $count);
				$themesItem = Themes::getThemeInfo($id);
				Router::View("/source/views/Themes/theme.php", [$themesItem, $Pcount]);
				return true;
			}
			else
				return false;
		}
		else
		{
			Router::Error404();
		}
	}
}

?>