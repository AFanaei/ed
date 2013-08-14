<?php

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *	-- Global configuration
 * @package		EasyDev
 * @subpackage	Config/config
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

/*
|----- Default controller to load -----
*/
$config['defaultController'] = 'main';

/*
|----- Default controller method to load -----
*/
$config['defaultMethod'] = 'index';

/*
|----- Base site url. example: 'http://example.com/' ( Don't forget the trailing slash ) -----
*/
$config['baseUrl'] = '';

/*
|----- Default language -----
	Based on ISO 639-1 codes. http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
*/
$config['language'] = 'en';

/*
|----- Default character set -----
*/
$config['charset'] = 'UTF-8';

/*
|----- Index Page -----
*/
$config['setIndexPage'] = TRUE;
$config['indexPage'] = 'index.php';

/*
|----- Url suffix -----
*/
$config['urlSuffix'] = '';

/*
|----- Allowed url characters - Regular expression -----
*/
$config['allowedUriChars'] = 'A-z0-9\-';

/*
|----- Enable query string -----
*/
$config['switchToQueryString'] = FALSE;
$config['controllerKey'] = 'c';
$config['functionKey'] = 'm';
$config['directoryKey'] = 'd';

/*
|----- Output compression 'zlib' -----
*/
$config['enableCompression'] = FALSE;

/*
|----- Master time reference -----
	Time references: http://www.php.net/manual/en/timezones.php
*/
$config['masterTime'] = 'UTC';

?>