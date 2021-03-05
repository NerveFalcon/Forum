<?php 
class Inquiry
{
	private $db;
	private $query;

	/**
	 * Создание класса mysqli подключенного к БД
	 * @param string $username из под какого пользователя подключаться к БД
	 */
	public static function getConnection(string $username = 'falcon'){
		$allParams = include(ROOT."/source/config/db_params.php");
		$params = $allParams[$username];

		return new mysqli($params['host'], $params['username'], $params['passwd'], $params['dbname']);
	}

	/**
	 * Возвращает количество записей в результате
	 * @return integer
	 */
	public function Count()
	{
		return $this->query->num_rows();
	}

	/**
	 * Перемещает указатель на выбранную строку
	 * @param integer $i identificator
	 *  */	
	public function move($i)
	{
		return $this->query->data_seek($i);
	}

	/**
	 * Получение строки результирующей таблицы в виде массива
	 * @return array
	 */
	public function fetch_row()
	{
		return $this->query->fetch_row();
	}

	/**
	 * Получение строки результирующей таблицы в виде ассоциативного массива
	 * @return array
	 */
	public function fetch_assoc()
	{
		return $this->query->fetch_assoc();
	}

	/**
	 * Получение строки результирующей таблицы в виде массива
	 * @param integer $flag [MYSQL_ASSOC || MYSQL_NUM || MYSQL_BOTH]
	 * 
	 * @return array
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
?>