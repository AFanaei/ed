<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		EasyDev
 * @subpackage	Kernel/Model
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class ED_Model
{
	/*
	|----- Constructor -----
	*/
	function __construct()
	{
		writeLog('Debug', 'View class initialized.');
	}
	
	/*
	|----- Allows models to access ED's loaded classes -----
	*/
	function __get($key)
	{
		$ED =& getObjectInstance();
		return $ED->$key;
	}
}