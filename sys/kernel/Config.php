<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		EasyDev
 * @subpackage	Kernel/Config
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class ED_Config
{
	var $_config = array();
	
	/*
	|----- Config class constructor. Set the baseUrl value if not defined by user -----
	*/
	function __construct()
	{
		if (file_exists(APPPATH.'config/config.php'))
		{
			require(APPPATH.'config/config.php');

			if (isset($config) AND is_array($config))
			{
				foreach ($config as $key => $val)
				{
					$this->_config[$key] = $val;
				}
				
				if ($this->_config['baseUrl'] == '')
				{
					if (isset($_SERVER['HTTP_HOST']))
					{
						$this->_config['baseUrl'] = (isset($_SERVER['HTTPS']) AND strtolower($_SERVER['HTTPS']) === 'on')? 'https' : 'http';
						$this->_config['baseUrl'] .= '://'. $_SERVER['HTTP_HOST'];
						$this->_config['baseUrl'] .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
					}
					else
					{
						$this->_config['baseUrl'] = 'http://localhost/';
					}
				
				}
				
				header('Content-Type: text/html; charset='.$this->_config['charset']);
			}
		}
		
		writeLog('Debug', 'Config class initialized.');
	}
}
?>