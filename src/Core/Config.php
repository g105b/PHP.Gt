<?php
/**
 * Loads the config.ini file from the application root and parses it into this
 * object's properties, for use within Gt and the application.
 *
 * PHP.Gt (http://php.gt)
 * @copyright Copyright Ⓒ 2015 Bright Flair Ltd. (http://brightflair.com)
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
namespace Gt\Core;

use Gt\Config\Config as v3Config;
use Gt\Config\ConfigFactory;

class Config implements \ArrayAccess {

const DEFAULT_CONFIG_FILE = "default.ini";
private $configArray = [];

public function __construct($defaultConfigArray = null) {
	$configPath = Path::get(Path::ROOT) . "/config.ini";
	$defaultConfigPath = Path::get(Path::GTROOT) . "/" . self::DEFAULT_CONFIG_FILE;
	$defaultConfig = ConfigFactory::createFromPathName($defaultConfigPath);
	$this->v3Config = ConfigFactory::createFromPathName($configPath);
	$this->v3Config->merge($defaultConfig);
}

public function offsetExists($offset) {
	$section = $this->v3Config->getSection($offset) ?? null;
	return !is_null($section);
}

public function offsetGet($offset) {
	$obj = new ConfigObj();
	$obj->setName($offset);

	$section = $this->v3Config->getSection($offset) ?? [];

	foreach($section as $key => $value) {
		$obj->$key = $value;
	}

	return $obj;
}

public function offsetSet($offset, $value) {}
public function offsetUnset($offset) {}

}#