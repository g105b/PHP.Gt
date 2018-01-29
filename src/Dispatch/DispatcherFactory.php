<?php
namespace Gt\WebEngine\Dispatch;

use Gt\Config\Config;
use Gt\Cookie\Cookie;
use Gt\Http\ServerInfo;
use Gt\Input\Input;
use Gt\Session\Session;
use Gt\WebEngine\Route\ApiRouter;
use Gt\WebEngine\Route\PageRouter;
use Gt\WebEngine\Route\Router;

class DispatcherFactory {
	public static function create(
		Config $config,
		ServerInfo $serverInfo,
		Input $input,
		Cookie $cookie,
		Session $session,
		Router $router
	):Dispatcher {
// TODO: Get App Namespace from config when implemented.
		$appNamespace = "App";

		if($router instanceof PageRouter) {
			$dispatcher = new PageDispatcher($router, $appNamespace);
		}
		if($router instanceof ApiRouter) {
			$dispatcher = new ApiDispatcher($router, $appNamespace);
		}

		$dispatcher->storeInternalObjects(
			$config,
			$serverInfo,
			$input,
			$cookie,
			$session
		);

		return $dispatcher;
	}
}