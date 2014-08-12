<?php
/**
 * Thrown when HTTP headers are attempted to be set, when they have already
 * been flushed to the browser. A common reason for this is accidental
 * white-space before an opening <?php tag, or misuse of closing ?> tags.
 *
 * PHP.Gt (http://php.gt)
 * @copyright Copyright Ⓒ 2014 Bright Flair Ltd. (http://brightflair.com)
 * @license Apache Version 2.0, January 2004. http://www.apache.org/licenses
 */
namespace Gt\Response;

class HeadersAlreadySentException extends \Gt\Core\Exception\GtException {}#