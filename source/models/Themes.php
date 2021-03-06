<?php 
/**
 * Модель работы с темами
 */
class Themes  
{

	/**
	 * Возвращает одну тему по id
	 * @param integer $id идентификатор конкретной темы
	 * @return array Ассоциативный массив, содержащий автора, заголовок и описание темы
	 */
	public static function getThemeInfo($id)
	{
		$id = intval($id);

		if($id)
		{
			$db = Inquiry::getConnection();
			$db->set_charset('utf-8');
			$result = $db->query("select login as author, title, description "
								."from themes left join users "
								."on ( themes.id_creator = users.id) "
								."where themes.id = $id"
								);
			return $result->fetch_all(1)[0];
		}
	}

	/**
	 * Возвращает количество тем
	 * @return int Количество тем
	 */
	public static function getThemesCount()
	{
		$db = Inquiry::getConnection();
		$db->set_charset('utf-8');
		$result = $db->query("select count(*) as c from themes where active = 1");
		return $result->fetch_all(1)[0]['c'];
	}

	/**
	 * Возвращает массив тем
	 * @param int $begin Номер 1й темы на странице
	 * @param int $count Количество тем на странице
	 * @return array Массив ассоциативных массивов, содержащих строки результата
	 */
	public static function getThemesList(int $begin, int $count)
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
	 * Возвращает количество сообщений
	 * @param int $id Идентификатор темы
	 * @return int Количество сообщений
	 */
	public static function getMsgCount($id)
	{
		$db = Inquiry::getConnection();
		$db->set_charset('utf-8');
		$result = $db->query("select count(*) as c "
							."from messeges "
							."where id_theme = $id"
							);
		return $result->fetch_all(1)[0]['c'];
	}

	/**
	 * Возвращает массив коммнтариев конкретной темы
	 * @param int $id Идентификатор темы
	 * @param int $begin Номер 1й темы на странице
	 * @param int $count Количество тем на странице
	 * @return array Массив ассоциативных массивов, содержащих строки результата
	 */
	public static function getMsgList(int $id, int $begin, int $count)
	{
		$db = Inquiry::getConnection();
		$db->set_charset('utf-8');
		$result = $db->query("select id_creator as commentator, date, text "
							."from messages "
							."where id_theme = $id "
							."limit $begin, $count"
							);
	}

	/**
	 * Возвращает первые $n сообшений
	 * @param int $n Количество сообщений
	 * @return array Массив ассоциативных массивов, содержащих строки результата
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
							."where rn <= $n");
		return $result->fetch_all(1);
	}

}
?>