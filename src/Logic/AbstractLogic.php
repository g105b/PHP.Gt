<?php
namespace Gt\WebEngine\Logic;

use Gt\Config\Config;
use Gt\Cookie\CookieHandler;
use Gt\Database\Database;
use Gt\Http\ServerInfo;
use Gt\Input\Input;
use Gt\Session\Session;

abstract class AbstractLogic {
	protected $viewModel;
	/** @var Config */
	protected $config;
	/** @var ServerInfo */
	protected $server;
	/** @var Input */
	protected $input;
	/** @var CookieHandler */
	protected $cookie;
	/** @var Session */
	protected $session;
	/** @var Database */
	protected $database;
	/** @var DynamicPath */
	protected $dynamicPath;

	public function __construct(
		$viewModel,
		Config $config,
		ServerInfo $serverInfo,
		Input $input,
		CookieHandler $cookieHandler,
		Session $session,
		Database $database,
		DynamicPath $dynamicPath
	) {
// $viewModel must be stored by this class's concrete constructors, as each type of Logic class
// will have its own type and implementation.
		$this->config = $config;
		$this->server = $serverInfo;
		$this->input = $input;
		$this->cookie = $cookieHandler;
		$this->session = $session;
		$this->database = $database;
		$this->dynamicPath = $dynamicPath;
	}

	abstract public function go();

	public function handleDo():void {
		foreach($this->input as $key => $value) {
			if($key !== "do") {
				continue;
			}

			$methodName = "do";
			$methodName .= ucfirst($value);

			if(method_exists($this, $methodName)) {
				$this->input->do($value)->call([$this, $methodName]);
			}
		}
	}

	protected function reload():void {
		$this->redirect($this->server->getRequestUri());
	}

	protected function redirect(string $uri, int $code = 303):void {
		header(
			"Location: $uri",
			true,
			$code
		);
		exit;
	}

	protected function getDynamicPathParameter(string $parameter):?string {
		return $this->dynamicPath->get($parameter);
	}
}