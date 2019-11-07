<?php
namespace Gt\WebEngine\Test\Route;

use Gt\Http\Request;
use Gt\WebEngine\FileSystem\RequiredDirectoryNotFoundException;
use Gt\WebEngine\Route\PageRouter;
use Gt\WebEngine\Test\Helper\FunctionOverride\Override;
use PHPUnit\Framework\MockObject\MockObject;

class PageRouterTest extends RouterTestCase {
	public function testGetBaseViewLogicPath() {
		/** @var MockObject|Request $request */
		$request = self::createMock(Request::class);
		$sut = new PageRouter($request, "");
		$path = $sut->getBaseViewLogicPath();
		self::assertEquals("/page", $path);
	}

	/**
	 * @runInSeparateProcess
	 * @dataProvider dataUri
	 */
	public function testRedirectIndex(string $uri) {
		Override::replace("header", __DIR__);
		$request = self::createMock(Request::class);
		$sut = new PageRouter($request, "");
		$sut->redirectIndex($uri);

		$expectedHeaderCalls = [];
		$lastPartOfUri = substr(
			$uri,
			strrpos($uri, "/") + 1
		);
		$uriNoLastPart = substr($uri, 0, strrpos($uri, "/"));
		if($lastPartOfUri === "index") {
			$expectedHeaderCalls []= ["Location: $uriNoLastPart", true, 303];
		}

		self::expectCallsToFunction("header", $expectedHeaderCalls);
	}

	public function testGetViewAssemblyNoPageDir() {
		$tmp = $this->getTmpDir("testGetViewAssemblyNoPageDir");
		touch("$tmp/composer.json");

		$request = self::createMock(Request::class);
		$sut = new PageRouter($request, $tmp);
		self::expectException(RequiredDirectoryNotFoundException::class);
		$sut->getViewAssembly("/");
	}

	public function testGetViewAssembly() {
		$tmp = $this->getTmpDir("testGetViewAssembly");
		touch("$tmp/composer.json");
		mkdir("$tmp/page");
		touch("$tmp/page/index.html");

		$request = self::createMock(Request::class);
		$sut = new PageRouter($request, $tmp);
		$assembly = $sut->getViewAssembly("/");

		$i = null;

		foreach($assembly as $i => $assemblyPart) {
			self::assertFileExists($assemblyPart);
		}
		self::assertNotNull($i);
	}
}