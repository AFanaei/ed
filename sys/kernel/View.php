<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		EasyDev
 * @subpackage	Kernel/View
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class ED_View
{
	/*
	|----- Constructor -----
	*/
	public function __construct()
	{
		writeLog('Debug', 'View class initialized.');
	}
	
	/*
	|----- Allows views to access EDSuperObject's loaded classes -----
	*/
	function __get($class)
	{
		$EDSuperObject =& getObjectInstance();
		return $EDSuperObject->$class;
	}
}

?>