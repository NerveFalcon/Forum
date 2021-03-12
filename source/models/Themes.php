<?php

/**
 * Модель работы с темами
 */
class Themes
{

	#region Список тем

	/**
	 * Возвращает количество всех тем
	 * @return int Количество всех тем
	 */
	public static function findThemeById(int $id)
	{
		$db = Inquiry::getConnection();
		$result = $db->query("select id as c from themes where id = '$id';");
		$db->close();

		return $result->fetch_all(1)[0]['c'];
	}

	/**
	 * Возвращает количество активных тем
	 * @return int Количество активных тем
	 */
	public static function getActiveThemesCount()
	{
		$db = Inquiry::getConnection();
		$result = $db->query("select count(*) as c from themes where active = 1");
		$db->close();

		return $result->fetch_all(1)[0]['c'];
	}

	/**
	 * Возвращает массив активных тем
	 * @param int $begin Номер 1й темы на странице
	 * @param int $count Количество тем на странице
	 * @return array Массив ассоциативных массивов, содержащих список активных тем
	 */
	public static function getActiveThemesPage(int $begin, int $count)
	{
		$db = Inquiry::getConnection();
		$result = $db->query(
			"select id, title, description as `desc` "
				. "from themes "
				. "where active = 1 "
				. "order by id "
				. "limit $begin, $count"
		);
		$db->close();

		return $result->fetch_all(1);
	}

	/**
	 * Возвращает первые $n сообшений всех тем
	 * @param int $n Количество сообщений
	 * @return array Массив ассоциативных массивов, содержащих строки результата
	 */
	public static function getNMsgFromAllThemes(int $n)
	{
		$db = Inquiry::getConnection();
		$result = $db->query(
			"select v.id_theme, v.text, v.date from  "
			."( "
				."select t1.id_theme, t1.text, t1.date, "
				."( "
					."select count(1) "
					."from messages t0 "
					."where t1.id_theme = t0.id_theme "
					."and t1.id >= t0.id "
				.") as rn "
				."from messages t1 "
			.") v "
			."where rn <= $n"
		);
		$db->close();

		return $result->fetch_all(1);
	}

	#endregion

	#region Конкретная тема

	/**
	 * Возвращает одну тему по id
	 * @param int $id идентификатор конкретной темы
	 * @return array Ассоциативный массив, содержащий автора, заголовок и описание темы
	 */
	public static function getThemeById(int $id)
	{
		$db = Inquiry::getConnection();
		$result = $db->query(
			"select id_creator, login as author, title, description, date "
				. "from themes left join users "
				. "on ( themes.id_creator = users.id) "
				. "where themes.id = $id"
		);
		$db->close();

		return $result->fetch_all(1)[0];
	}

	/**
	 * Возвращает количество сообщений
	 * @param int $id Идентификатор темы
	 * @return int Количество сообщений
	 */
	public static function getMsgCountByThemeId(int $id)
	{
		$db = Inquiry::getConnection();
		$result = $db->query(
			"select count(*) as c "
				. "from messages "
				. "where id_theme = $id"
		);
		$db->close();

		return $result->fetch_all(1)[0]['c'];
	}

	/**
	 * Возвращает массив сообщений конкретной темы
	 * @param int $id Идентификатор темы
	 * @param int $begin Номер 1й темы на странице
	 * @param int $count Количество тем на странице
	 * @return array Массив ассоциативных массивов, содержащих сообщения
	 */
	public static function getMsgPageByThemeId(int $id, int $begin, int $count)
	{
		$db = Inquiry::getConnection();
		$result = $db->query(
			"select id_creator, login as commentator, date, text "
				. "from messages left join users "
				. "on ( id_creator = users.id) "
				. "where id_theme = $id "
				. "limit $begin, $count"
		);
		$db->close();

		return $result->fetch_all(1);
	}

	#endregion

	#region Кнопки перехода между страницами

	/**
	 * Функция постороения контейнера кнопок переключения страниц
	 * @param int $lastPage Номер последней страницы (количество страниц)
	 * @param int $currentPage Номер текущей страницы
	 * @return string Контейнер кнопок переключения страницы в виде html-кода
	 */
	public static function buildPageBtnsContainer(int $lastPage, int $currentPage)
	{
		if ($lastPage < 2)
		{
			return false;
		}
		$container = '<div class="pg-btn flex-container-row flex-center">';
		if ($lastPage < 7)
		{
			$container .= Themes::buildPageBtns(1, $lastPage, $currentPage);
		}
		else
		{
			$condition = ($currentPage < 4) ? -1 : (($currentPage > $lastPage - 3) ? 1 : 0);
			switch ($condition)
			{
				case -1:
					$container .= Themes::buildPageBtns(1, 4, $currentPage);
					$container .= "..." . Themes::buildPageBtn($lastPage);
					break;
				case 0:
					$container .= Themes::buildPageBtn(1);
					$container .= "..." . Themes::buildPageBtns($currentPage - 1, $currentPage + 1, $currentPage);
					$container .= "..." . Themes::buildPageBtn($lastPage);
					break;
				case 1:
					$container .= Themes::buildPageBtn(1);
					$container .= "..." . Themes::buildPageBtns($lastPage - 3, $lastPage, $currentPage);
					break;
			}
		}
		$container .= '</div>';
		return $container;
	}

	/**
	 * Функция постороения кнопок переключения страниц
	 * @param int $firstPage Номер страницы c которой начинается построение
	 * @param int $lastPage Номер страницы на которой заканчивается построение
	 * @param int $currentPage Номер текущей страницы
	 * @return string html-код вида { a.flex-item-row > fromphp > n }
	 */
	public static function buildPageBtns(int $firstPage, int $lastPage, int $currentPage)
	{
		$buttons = "";
		for ($i = $firstPage; $i <= $lastPage; $i++)
		{
			$buttons .= Themes::buildPageBtn($i, $currentPage);
		}
		return $buttons;
	}

	/**
	 * Возвращает одну кнопку переключения страниц
	 * @param int $buildPage Номер страницы
	 * @param int $currentPage Номер текущей страницы
	 */
	public static function buildPageBtn(int $buildPage, int $currentPage = null)
	{
		$class = '';
		if ($currentPage == $buildPage)
		{
			$class .= 'currentPage';
		}
		return "<a href='/themes/$buildPage' class='flex-item-row'><fromphp class='$class'>$buildPage</fromphp></a>";
	}

	#endregion

	#region Создание темы

	public static function createTopic($title, $desc, $id)
	{
		$db = Inquiry::getConnection();
		$result  = $db->query("insert into themes(id_creator, title, description) values ('$id', '$title', '$desc');");
		$result = $db->insert_id;

		$db->close();
		return $result;
	}

	/**
	 * Проверка валидности новой темы
	 * @param string $title Заголовок темы
	 * @param string $desc Описание темы
	 * @return array Возвращает массив ошибок\
	 * пустой массив, если проверка пройдена
	 */
	public static function checkTopic(string $title, string $desc)
	{
		$err = array();
		$tLen = strlen($title);
		$dLen = strlen($desc);

		if (($tLen > 64) || ($tLen < 6))
		{
			$err[] = "Заголовок не может быть меньше 6 и больше 64 символов";
		}
		else if (($dLen > 256) || ($dLen < 16))
		{
			$err[] = "Описание не может быть меньше 16 и больше 256 символов";
		}
		else if (Themes::findTheme($title))
		{
			$err[] = "Тема с таким названием уже существует";
		}

		return $err;
	}

	public static function findTheme(string $title)
	{
		$db = Inquiry::getConnection();
		$query = $db->query("select * from themes where title = '$title';");
		$db->close();

		if (empty($query->fetch_all(1)))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	#endregion

}
