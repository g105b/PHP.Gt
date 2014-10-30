<?php
/**
 * PHP.Gt (http://php.gt)
 * @copyright Copyright Ⓒ 2014 Bright Flair Ltd. (http://brightflair.com)
 * @license Apache Version 2.0, January 2004. http://www.apache.org/licenses
 */
namespace Gt\Core;

class DirectoryIteratorTest extends \PHPUnit_Framework_TestCase {

public function setUp() {
	$tmp = \Gt\Test\Helper::createTmpDir();
}

public function tearDown() {
	\Gt\Test\Helper::cleanup(Path::get(Path::ROOT));
}

public function testCallback() {
	$path = Path::get(Path::ROOT);
	$filePathArray = [];

	$this->createDirectoryStructure($path, 5, 5);

	$outputArray = DirectoryIterator::walk(
		Path::get(Path::ROOT), [$this, "walkCallback"]);
	$this->assertInternalType("array", $outputArray);

	foreach ($outputArray as $outputItem) {
		$innerFilePath = substr($outputItem, strpos($outputItem, "/"));
		$this->assertFileExists($innerFilePath);
	}
}

/**
 * @expectedException \Gt\Core\Exception\RequiredAppResourceNotFoundException
 */
public function testWalkOnDirectoryThatDoesNotExist() {
	DirectoryIterator::walk("/" . uniqid(true), null);
}

public function testHash() {
	$path = Path::get(Path::ROOT);
	$this->createDirectoryStructure($path, 5, 5);

	$md5Array = DirectoryIterator::walk($path, [$this, "hashCallback"]);
	$md5 = implode("", $md5Array);

	$md5 = md5($md5);

	$hash = DirectoryIterator::hash(Path::get(Path::ROOT));
	$this->assertEquals($md5, $hash);
}

private function createDirectoryStructure($basePath, $depth, $leaves) {
	for($d = 1; $d < $depth; $d++) {
		$path = "$basePath/";
		$path .= implode("/", array_fill(0, $d, "dir"));

		if(!is_dir($path)) {
			mkdir($path, 0775, true);
		}

		for($l = 1; $l <= $leaves; $l++) {
			$leaf = "$path/leaf-$l.file";

			file_put_contents($leaf, "File contents of leaf-$l");
		}
	}
}

/**
 *
 */
public function walkCallback($file, $iterator) {
	$path = $file->getPathname();
	return $path;
}

/**
 *
 */
public function hashCallback($file, $iterator) {
	if($file->isDir()) {
		return null;
	}

	$path = $file->getPathname();
	return md5($path) . md5_file($path);
}

}#