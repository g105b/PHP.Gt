<?php
/**
 * Test bootstrapper, used by PHPUnit.
 *
 * At the moment this file only has one task to require the Composer autoloader,
 * but is present to allow unit test complexity to grow in the future. May be
 * removed in the future if not required.
 *
 * PHP.Gt (http://php.gt)
 * @copyright Copyright Ⓒ 2014 Bright Flair Ltd. (http://brightflair.com)
 * @license Apache Version 2.0, January 2004. http://www.apache.org/licenses
 */
namespace Gt\Test;

require __DIR__ . "/../../vendor/autoload.php";

class Helper {

/**
 * Creates a directory in the system's temporary directory, with an optionally
 * given subdirectory, and returns the path.
 *
 * @param string|null $dir Name of the subdirectory to create
 *
 * @return string Absolute path to newly created directory
 */
public static function createTmpDir($dir = null) {
	$tmp = sys_get_temp_dir() . "/gt-temp-test";
	$_SERVER["DOCUMENT_ROOT"] = $tmp . "/www";

	$path = $tmp;

	if(!is_dir($path)) {
		mkdir($path, 0775, true);
	}

	if(!is_null($dir)) {
		// Ensure starting slash.
		if(substr($dir, 0, 1) !== "/") {
			$dir = "/" . $dir;
		}

		$path .= $dir;

		if(!is_dir($path)) {
			mkdir($path, 0775, true);
		}
	}


	return $path;
}

/**
 * Recursive function to empty and remove a whole directory.
 *
 * @param string $dirPath Path to directory to remove.
 * @return bool True if directory is successfully removed, otherwise false.
 */
public static function cleanup($dirPath) {
	foreach(new \RecursiveIteratorIterator(
	new \RecursiveDirectoryIterator($dirPath, \FilesystemIterator::SKIP_DOTS),
	\RecursiveIteratorIterator::CHILD_FIRST)
	as $path) {

		$path->isDir()
			? rmdir($path->getPathname())
			: unlink($path->getPathname());
	}

	return rmdir($dirPath);
}

/**
 * Randomises the case of each character in the provided string.
 *
 * @param string $string Input string
 *
 * @return string The provided string with each character randomised in case
 */
public static function randomiseCase($string) {
	for ($i = 0, $len = strlen($string); $i < $len; $i++) {
		$c = $string[$i];
		if(mt_rand(0, 1)) {
			$string[$i] = strtoupper($c);
		}
		else {
			$string[$i] = strtolower($c);
		}
	}

	return $string;
}

}#