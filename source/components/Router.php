<?php

class Router
{

	/**
	 * Получение URI запроса
	 * @return string|false Существующий запрос без "/" на краях, если найден, иначе false
	 */
	public static function GetURI()
	{
		if(!empty($_SERVER["REQUEST_URI"]))
		{
			return trim($_SERVER["REQUEST_URI"], "/");
		}
		else
			return false;
	}

	/**
	 * Обработка URI и активация контроллера
	 * @param array $routes Массив с шаблонами URI и ответственным методом контроллера
	 */
	public static function Run(array $routes)
	{
		$uri = Router::GetURI();

		foreach ($routes as $uriPattern => $path) {

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
				{
					include_once($controllerFile);
				}
				else
				{
					Router::Error404();
					exit();
				}

				// Создать объект, вызвать action
				// $conrollerObject = new $controllerName;
				$result = call_user_func_array(array($controllerName, $actionName), $parametres);
				if(!$result)
				{
					Router::View("/source/views/Main/404.php");
				}
				//debug info
				if((ini_get('display_errors') == 1) && !Ajax::isAjax())
				{
					echo '<div class="debug">';
						echo '<pre>session: ';
							print_r($_SESSION);
						echo 'coockie: ';
							print_r($_COOKIE);
						echo '</pre>';
						echo "$controllerName, $actionName() <= ";
						print_r($parametres);
					echo '</div>';
				}
				exit;
			}
		}
	}

	/**
	 * Отображение страницы
	 * @param string $path Путь к отображаемому документу
	 * @param mixed $params Параметры передаваемые на страницу
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
	}
}
?>