<?php 
/**
 * Модель работы с темами
 */
class Themes  
{
	/**
	 * Возвращает количество активных тем
	 * @return int Количество активных тем
	 */
	public static function getActiveThemesCount()
	{
		$db = Inquiry::getConnection();
		$db->set_charset('utf-8');
		$result = $db->query("select count(*) as c from themes where active = 1");
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
		$db->set_charset('utf-8');
		$result = $db->query("select id, title, description as `desc` "
							."from themes "
							."where active = 1 "
							."order by id "
							."limit $begin, $count"
							);
		return $result->fetch_all(1);
	}

	/**
	 * Возвращает количество всех тем
	 * @return int Количество всех тем
	 */
	public static function getAllThemesCount()
	{
		$db = Inquiry::getConnection();
		$db->set_charset('utf-8');
		$result = $db->query("select count(*) as c from themes");
		return $result->fetch_all(1)[0]['c'];
	}

	/**
	 * Возвращает количество сообщений
	 * @param int $id Идентификатор темы
	 * @return int Количество сообщений
	 */
	public static function getMsgCount(int $id)
	{
		$db = Inquiry::getConnection();
		$db->set_charset('utf-8');
		$result = $db->query("select count(*) as c "
							."from messages "
							."where id_theme = $id"
							);
		return $result->fetch_all(1)[0]['c'];
	}

	/**
	 * Возвращает массив сообщений конкретной темы
	 * @param int $id Идентификатор темы
	 * @param int $begin Номер 1й темы на странице
	 * @param int $count Количество тем на странице
	 * @return array Массив ассоциативных массивов, содержащих сообщения
	 */
	public static function getMsgByThemeId(int $id, int $begin, int $count)
	{
		$db = Inquiry::getConnection();
		$db->set_charset('utf-8');
		$result = $db->query("select id_creator, login as commentator, date, text "
							."from messages left join users "
							."on ( id_creator = users.id) "
							."where id_theme = $id "
							."limit $begin, $count"
							);
		return $result->fetch_all(1);
	}

	/**
	 * Возвращает одну тему по id
	 * @param int $id идентификатор конкретной темы
	 * @return array Ассоциативный массив, содержащий автора, заголовок и описание темы
	 */
	public static function getThemeById(int $id)
	{
		if($id)
		{
			$db = Inquiry::getConnection();
			$db->set_charset('utf-8');
			$result = $db->query("select id_creator, login as author, title, description, date "
								."from themes left join users "
								."on ( themes.id_creator = users.id) "
								."where themes.id = $id"
								);
			return $result->fetch_all(1)[0];
		}
	}

	/**
	 * Возвращает первые $n сообшений
	 * @param int $n Количество сообщений
	 * @return array Массив ассоциативных массивов, содержащих строки результата
	 */
	public static function getNMsgFromAllThemes(int $n)
	{
		$db = Inquiry::getConnection();
		$db->set_charset('utf-8');
		$result = $db->query("select v.id_theme, v.text, v.date from  "
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
							."where rn <= $n");
		return $result->fetch_all(1);
	}

}
?>