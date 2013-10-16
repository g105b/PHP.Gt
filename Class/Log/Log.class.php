<?php class Log {
/**
 * A configurable logging tool, accessable everywhere using static methods.
 * Basic usage allows logging to particularly-named file within the
 * application's root directory, along with priority-based logging, so dev
 * servers log more verbosely than live servers.
 */

private static $_loggers = array();
/**
 * Obtains an instance of the Logger class that will log out to the given named
 * file.
 */
public static function get($name = "Default") {
	if(!array_key_exists($name, self::$_loggers)) {
		self::$_loggers[$name] = new Logger($name);
	}

	return self::$_loggers[$name];
}

}#