<?php
class Inquiry
{
	private $db;
	private $query;

	public function __construct()
	{
		$this->db = Inquiry::getConnection();
		$this->query = $this->db->query("describe");
	}

	/**
	 * Создание класса mysqli подключенного к БД
	 * @param string $username Логин пользователя для подключения к БД
	 * @return \mysqli Соединение с БД
	 */
	public static function getConnection(string $username = 'falcon')
	{
		$allParams = include(ROOT . "/source/config/db_params.php");
		$params = $allParams[$username];

		$db =  new mysqli($params['host'], $params['username'], $params['passwd'], $params['dbname']);
		$db->set_charset("utf-8");

		return $db;
	}

	/**
	 * Возвращает количество записей в результате
	 * @return integer
	 */
	public function Count()
	{
		return $this->query->num_rows;
	}

	/**
	 * Перемещает указатель на выбранную строку
	 * @param integer $i Номер строки
	 *  */
	public function move($i)
	{
		return $this->query->data_seek($i);
	}

	/**
	 * Получение результирующей таблицы в виде нумерованного массива
	 * @return array
	 */
	public function fetch_row()
	{
		return $this->query->fetch_row();
	}

	/**
	 * Получение результирующей таблицы в виде ассоциативного массива
	 * @return array
	 */
	public function fetch_assoc()
	{
		return $this->query->fetch_assoc();
	}

	/**
	 * Получение результирующей таблицы в виде массива
	 * @param integer $flag [MYSQL_ASSOC || MYSQL_NUM || MYSQL_BOTH]
	 * @return array [$flag] массив
	 * */
	public function fetch_array($flag)
	{
		return $this->query->fetch_array($flag);
	}

	public function disconnect()
	{
		$this->db->close();
	}
}
