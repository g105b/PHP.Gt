<?php
/**
 * PHP.Gt (http://php.gt)
 * @copyright Copyright Ⓒ 2014 Bright Flair Ltd. (http://brightflair.com)
 * @license Apache Version 2.0, January 2004. http://www.apache.org/licenses
 */
namespace Gt\Session;

class Session_Test extends \PHPUnit_Framework_TestCase {

private $cfg;
private $session;

public function setUp() {
	$this->cfg = new \Gt\Core\ConfigObj([
		"case_sensitive"	=> false,
		"separator" 		=> ".",
		"base_namespace" 	=> "TestApp",
	]);
	$this->session = new Session($this->cfg);
}

public function testSessionStarts() {
	$this->assertEquals(Session::STATUS_ACTIVE, $this->session->getStatus());
}

public function testSessionCreatesObject() {
	$this->assertArrayHasKey("TestApp", $_SESSION,
		'Namespace should exist in session');
	$this->assertInstanceOf("\Gt\Session\Store", $_SESSION["TestApp"]);
}

public function testAddsSingleStore() {
	$key = "TestKey";
	$value = "TestValue";
	$this->assertFalse($this->session->exists($key));
	$this->session->set($key, $value);
	$this->assertTrue($this->session->exists($key));
	$this->assertEquals($this->session->get($key), $value);
}

public function testDeletesStore() {
	$key = "TestKey";
	$value = "TestValue";
	$this->assertFalse($this->session->exists($key));
	$this->session->set($key, $value);
	$this->session->delete($key);
	$this->assertFalse($this->session->exists($key));
}

public function testCaseSensitivity() {
	$key = "TestKey";
	$keyCi = strtolower($key);
	$value = "TestValue";

	$cfgCS = new \Gt\Core\ConfigObj([
		"case_sensitive"	=> true,
		"separator" 		=> ".",
		"base_namespace" 	=> "TestApp",
	]);

	$this->session->set($key, $value);
	$this->assertEquals($this->session->get($keyCi), $value);

	$this->session->setConfig($cfgCS);
	$this->assertFalse($this->session->exists($keyCi));
}

public function testNamespace() {
	$namespace = "Shop.Basket.items";
	$itemArray = ["beer", "wine", "cheese"];

	$this->session->set($namespace, $itemArray);
	$this->assertEquals(
		$this->session->get($namespace),
		$itemArray
	);

	$this->assertInstanceOf("\Gt\Session\Store",
		$this->session->get("Shop.Basket"));
}

public function testStoringNullValue() {
	$namespace = "A.Test.Namespace.thing";
	$this->session->set($namespace, null);
	$this->assertNull($this->session->get($namespace));
}

/**
 * @expectedException \Gt\Session\SessionStoreNotFoundException
 */
public function testInvalidGet() {
	$this->session->get("This.Namespace.Does.Not.Exist");
}

}#