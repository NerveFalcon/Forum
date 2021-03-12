<?php 
class Ajax
{

	/**
	 * Проверка на Ajax-запрос
	 * @return bool true если Ajax, иначе false
	 */
	public static function isAjax()
	{
		if	(isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
			&& !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
			&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
				return true;
		else
				return false;
	}
	
	/**
	 * Возвращает массив найденных тем
	 * @param string $search Поисковый запрос
	 * @return array Массив ассоциативных массивов, содержащих строки результата
	 */
	public static function getSearchThemes(string $search)
	{
		$db = Inquiry::getConnection();
		$result = $db->query("select id, title, description as `desc` "
							."from themes "
							."where active = 1 "
							."and title like '%$search%' "
							."order by id "
							."limit 10 "
							);
		$db->close();
		return $result->fetch_all(1);
	}
	
}
