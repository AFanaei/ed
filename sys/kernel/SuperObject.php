<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		EasyDev
 * @subpackage	Kernel/SuperObject
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class ED_SuperObject
{
	private static $objectInstance;
	
	/*
	|----- Constructor -----
	*/
	public function __construct()
	{
		self::$objectInstance =& $this;
		$this->init();
		writeLog('Debug', 'SuperObject class initialized.');
	}
	
	/*
	|----- Assign all loaded classes to 'SuperObject' object -----
	*/
	private function init()
	{
		foreach (isLoadedClass() as $objName)
		{
			$this->$objName =& loadClass('', '', $objName);
		}
	}
	
	/*
	|----- Return an instance of 'SuperObject' object -----
	*/
	public static function &getObjectInstance()
	{
		return self::$objectInstance;
	}
}

?>