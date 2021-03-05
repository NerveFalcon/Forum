<?php 
/**
 * Модель работы с темами
 */
class Themes  
{

	/**
	 * Возвращает одну тему по id
	 * @param integer $id
	 */
	public static function getThemesItemById($id)
	{
		$id = intval($id);

		if($id)
		{
			$db = Inquiry::getConnection();
			$db->set_charset('utf-8');
			$result = $db->query("select login as author, title, date, text "
								."from themes left join users "
								."on ( themes.id_creator = users.id) "
								."join messages on ( themes.id = messages.id_theme ) "
								."where themes.id = $id;"
								);
			return $result->fetch_all(1);
		}
	}

	/**
	 * Возвращает массив тем
	 */
	public static function getThemesList($b, $c)
	{
		$db = Inquiry::getConnection();
		$db->set_charset('utf-8');
		$result = $db->query("select id, title "
							."from themes "
							."where active = 1 "
							."order by id "
							."limit $b, $c"
							);
		return $result->fetch_all(1);
	}

	/**
	 * Возвращает описание темы
	 */
	public static function getThemesMsg(int $n)
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
							."where rn <= $n;");
		return $result->fetch_all(1);
	}

	/**
	 * Возвращает количество тем
	 */
	public static function getThemesCount()
	{
		$db = Inquiry::getConnection();
		$db->set_charset('utf-8');
		$result = $db->query("select count(*) as c from themes;");
		return $result->fetch_all(1)[0]['c'];
	}

	/**
	 * Возвращает количество сообщений
	 */
	public static function getMsgCount()
	{
		$db = Inquiry::getConnection();
		$db->set_charset('utf-8');
		$result = $db->query("select count(*) as c from themes where active = 1;");
		return $result->fetch_all(1)[0]['c'];
	}
}
?>