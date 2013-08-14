<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *	-- Input functions
 * @package		EasyDev
 * @subpackage	Libraries/Input
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class ED_Input
{
	/*
	|----- Input class constructor -----
	*/
	function __construct()
	{
		$this->security =& loadClass('Security', 'ED_Security', 'security');
		
		writeLog('Debug', 'Input class initialized.');
	}
	
	/*
	|----- Return $_POST value -----
	*/
	public function post($name, $safeMode = NULL)
	{
		$safeMode = ($safeMode == NULL) ? $this->security->_secConf['safeMode'] : $safeMode;
		
		if (isset($_POST[$name]))
		{
			if (is_array($_POST[$name]))
			{
				$args = array();
				
				$temp = $_POST[$name];
				
				foreach ($temp as $key => $val)
				{
					$args[$key] = ($safeMode) ? $this->security->xssSafe($val) : $val;
				}
				
				return $args;
			}
			
			return ($safeMode) ? $this->security->xssSafe($_POST[$name]) : $_POST[$name];
		}
		
		return FALSE;
	}
	
	/*
	|----- Return $_GET value -----
	*/
	public function get($name, $safeMode = NULL)
	{
		$safeMode = ($safeMode == NULL) ? $this->security->_safeMode : $safeMode;
		
		if (isset($_GET[$name]))
		{
			return ($safeMode) ? $this->security->xssSafe($_GET[$name]) : $_GET[$name];
		}
		
		return FALSE;
	}
	
	
}

?>