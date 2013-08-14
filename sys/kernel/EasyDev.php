<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
* EasyDev
*
* An open source application development framework for PHP 5.1.6 or newer
*
* @package		EasyDev
* @subpackage	Kernel/EasyDev
* @Developer	Hassan nasiri
* @copyright	Copyright (c) 2013, Hassan nasiri
* @license		http://www.gnu.org/licenses/gpl.html
* @website		---
* @since		Version 1.0
*/

// ------------------------------------------------------------------------

/*
|----- Load public functions -----
*/
require(SYSPATH.'kernel/Global.php');

/*
|----- Load Language Class -----
*/
$lang =& loadClass('Language', 'ED_Language', 'lang');

/*
|----- Load Output class -----
*/
$out =& loadClass('Output', 'ED_Output', 'output');

/*
|----- Load uri class -----
*/
$log =& loadClass('Log', 'ED_Log', 'log');

/*
|----- Load uri class -----
*/
$uri =& loadClass('Uri', 'ED_Uri', 'uri', 'kernel');

/*
|----- Load routing class -----
*/
$route =& loadClass('Router', 'ED_Router', 'router', 'kernel');

/*
|----- Load 'Loader' class with 'Load' object name -----
*/
$loader =& loadClass('Loader', 'ED_Loader', 'load', 'kernel');

/*
|----- Load SuperObject -----
*/
buildSuperObject();

/*
|----- Load base controller -----
*/
require(SYSPATH.'kernel/Controller.php');

/*
|----- Load base Model -----
*/
require(SYSPATH.'kernel/Model.php');

/*
|----- Load base view -----
*/
require(SYSPATH.'kernel/View.php');




/*
|----- Set the routing and then call requested method -----
*/

$route->setRouting();

?>
