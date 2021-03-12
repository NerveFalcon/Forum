<?php
include_once ROOT . "/source/models/Themes.php";
/**
 * Контроллер отвечающий за представление тем
 */
class ThemesController
{

	/**
	 * Представление поиска по всем темам с постраничным выводом
	 * @link http://www.php.my/search
	 * @return bool true если представление успешно загружено\
	 * false если представление не загружено
	 */
	public static function actionSearch()
	{
		if (Ajax::isAjax())
		{
			header('Content-Type: text/json; charset=utf-8');
			$list = Ajax::getSearchThemes($_POST['search']);
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
	 * @link http://www.php.my/themes
	 * @return bool true если представление успешно загружено\
	 * false если представление не загружено
	 */
	public static function actionThemes(int $page = 1, int $count = ITEMS_ON_PAGE)
	{
		$page = ($page < 1) ? 0 : $page - 1;
		$themesCount = Themes::getActiveThemesCount();
		if ($themesCount >= ($page * $count))
		{
			$Pcount = ceil($themesCount / $count);
			$activeThemes = Themes::getActiveThemesPage($page * $count, $count);
			Router::View("/source/views/Themes/themes.php", [$activeThemes, $Pcount, $page + 1]);
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
	 * @link http://www.php.my/theme
	 * @return bool true если представление успешно загружено\
	 * false если представление не загружено
	 */
	public static function actionMsg(int $id, int $page = 1, int $count = ITEMS_ON_PAGE)
	{
		if ($id == Themes::findThemeByID($id))
		{
			$page = ($page < 1) ? 0 : $page - 1;
			$msgCount = Themes::getMsgCountByThemeId($id);
			if ($msgCount < $count)
			{
				$Pcount = $msgCount;
			}
			else
			{
				$Pcount = $msgCount / $count;
			}
			$msgList = Themes::getMsgPageByThemeId($id, $page * $count, $count);
			$themeItem = Themes::getThemeById($id);
			Router::View("/source/views/Themes/theme.php", [$themeItem, $msgList, $Pcount, $page + 1]);
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Представление добавления темы
	 * @link http://www.php.my/create
	 * @return bool true если представление успешно загружено\
	 * false если представление не загружено
	 */
	public static function actionCreate()
	{
		if (!isset($_SESSION['login']))
		{
			header("Location: /auth");
			return true;
		}
		if (Ajax::isAjax())
		{
			header('Content-Type: text/json; charset=utf-8');
			$title = trim($_POST['title']);
			$desc = trim($_POST['description']);
			$check = Themes::checkTopic($title, $desc);
			if (empty($check))
			{
				$check[1] = Themes::createTopic($title, $desc, $_SESSION['id']);
				if ($check[1])
				{
					$check[0] = "OK";
					echo json_encode($check);
					return true;
				}
				else
				{
					$check[] = "Не удалось занести запись в БД";
					echo json_encode($check);
					return false;
				}
			}
			else
			{
				echo json_encode($check);
			}
			return true;
		}
		else
		{
			Router::View("/source/views/Themes/create.php");
			return true;
		}
	}
}
