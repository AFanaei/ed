<?php

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		EasyDev
 * @subpackage	Root/Index
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

/*
|----- Sys folder name -----
*/
$_base['sysPath'] = 'sys';
/*

/*
|----- App folder name -----
*/
$_base['appPath'] = 'app';
/*

/*
|----- Path to the 'kernel' folder -----
*/
if (realpath($_base['sysPath']) !== FALSE )
{
	$_base['sysPath'] = realpath($_base['sysPath']);
	$_base['sysPath'] = rtrim($_base['sysPath'], '/').'/';
}

if (! is_dir($_base['sysPath']))
{
	exit("Your kernel folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
}

define('SYSPATH', str_replace("\\", "/", $_base['sysPath']));

/*

/*
|----- Path to the 'Application' folder -----
*/
if (realpath($_base['appPath']) !== FALSE )
{
	$_base['appPath'] = realpath($_base['appPath']);
	$_base['appPath'] = rtrim($_base['appPath'], '/').'/';
}

if (! is_dir($_base['appPath']))
{
	exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
}

define('APPPATH', str_replace("\\", "/", $_base['appPath']));


require (SYSPATH.'kernel/EasyDev.php');

?>