<?php
/**
 * Represents the HTTP response header list. Used to send HTTP headers on the
 * response.
 *
 * PHP.Gt (http://php.gt)
 * @copyright Copyright Ⓒ 2014 Bright Flair Ltd. (http://brightflair.com)
 * @license Apache Version 2.0, January 2004. http://www.apache.org/licenses
 */
namespace Gt\Response;

class Headers {

private static $headerArray = [];

/**
 * Adds the given HTTP header to the list of headers, to be sent with the HTTP
 * response.
 *
 * @param string $field The name of the HTTP header field
 * @param string $value The value of the HTTP header
 *
 * @return string The raw header, as it is sent over HTTP
 */
public static function add($field, $value) {
	$field = ucfirst($field);
	self::$headerArray[$field] = $value;

	return self::getRaw($field, $value);
}

/**
 * Return the value of the header with the given field name.
 *
 * @param string $field The name of the HTTP header field
 *
 * @return string|null The value of the HTTP header, or null if there is
 * nothing set.
 */
public static function get($field) {
	$field = ucfirst($field);

	if(isset(self::$headerArray[$field])) {
		return self::$headerArray[$field];
	}

	return null;
}

/**
 * Get a list of all headers ready to be sent as an array.
 *
 * @return array Associative array of headers ready to be sent
 */
public static function getAll() {
	return self::$headerArray;
}

/**
 * Sends all the headers currently waiting to be sent.
 *
 * @return string The raw HTTP representation of all headers sent
 */
public static function send() {
	$rawAll = "";
	foreach (self::$headerArray as $field => $value) {
		$raw = self::getRaw($field, $value);
		header($raw);

		$rawAll .= $raw . PHP_EOL;
	}

	return $rawAll;
}

/**
 * From a given field name and value, return the HTTP/1.1 raw header string.
 * Each header field consists of a name followed by a colon (":") and the
 * field value. Field names are case-insensitive.
 * See: http://www.w3.org/Protocols/rfc2616/rfc2616.html
 *
 * @param string $field The name of the HTTP header field
 * @param string $value The value of the HTTP header
 *
 * @return string The raw header, as it is sent over HTTP
 */
public static function getRaw($field, $value) {
	$field = ucfirst($field);
	return "$field: $value";
}

}#