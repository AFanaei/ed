<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *	-- Xml Parser ( Based on the simpleXml )
 * @package		EasyDev
 * @subpackage	Libraries/Xml
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class ED_Xml
{

	var $xmlObj = NULL;
	
	function __construct()
	{
	
	}
	
	public function getXml($path)
	{
		if ($this->xmlObj = simplexml_load_file($path))
		{
			return $this->xmlObj;
		}
	}
}

?>