#!/usr/bin/env php
<?php
/**
 * Wrapper script that runs all unit and itegration tests in the project.
 * Currently, a simple call to phpunit binary is all that is required.
 *
 * PHP.Gt (http://php.gt)
 * @copyright Copyright Ⓒ 2014 Bright Flair Ltd. (http://brightflair.com)
 * @license Apache Version 2.0, January 2004. http://www.apache.org/licenses
 */

chdir(__DIR__);
system("../Packages/bin/phpunit");