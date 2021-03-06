<?php

class Router
{
	private $routes;

	public function __construct() 
	{
		$routesPath = ROOT."/source/config/routes.php";
		$this->routes = include($routesPath);
	}

	/**
	 * Получение URI запроса
	 * @return string Передается существующий запрос без "/" на краях
	 * @return false Если запрос не найден
	 */
	public static function GetURI()
	{
		if(!empty($_SERVER["REQUEST_URI"]))
		{
			$uri = trim($_SERVER["REQUEST_URI"], "/");
			$uri = str_replace("index.php/", "", $uri);
			return $uri;
		}
		else
			return false;
	}

	/**
	 * Обработка URI и активация контроллера
	 */
	public function run()
	{
		// Получить строку запроса
		$uri = $this->GetURI();

		// Проверить наличие запроса в routes.php
		foreach ($this->routes as $uriPattern => $path) {

			if(preg_match("~$uriPattern~", $uri))
			{
				//Получаем внутренний путь из внешнего согласно правилу
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);

				//Определить контроллер, action и параметры
				$parametres = explode("/", $internalRoute);
				$controllerName = ucfirst(array_shift($parametres))."Controller";
				$actionName = "action".ucfirst(array_shift($parametres));

				//Подключить файл класса-контроллера
				$controllerFile = ROOT."/source/controllers/".$controllerName.".php";
				if(file_exists($controllerFile))
					include_once($controllerFile);

				// Создать объект, вызвать action
				// $conrollerObject = new $controllerName;
				$result = call_user_func_array(array($controllerName, $actionName), $parametres);
				if(!$result)
					Router::View("/source/views/Main/404.php");
				if((ini_get('display_errors') == 1) && !Ajax::isAjax())
				{
					echo "$controllerName, $actionName() <= ";
					print_r($parametres);
				}
				exit;
			}
		}
	}

	/**
	 * Отображение страницы
	 * @param string $path Путь к отображаемому документу
	 */
	public static function View(string $path, $params = null)
	{
		require_once(ROOT."/source/views/Main/head.php");
		require_once(ROOT.$path);
		require_once(ROOT."/source/views/Main/foot.php");
	}

	/**
	 * Ошибка 404
	 */
	public static function Error404()
	{
		Router::View("/source/views/Main/404.php");
		return true;
	}
}
?>