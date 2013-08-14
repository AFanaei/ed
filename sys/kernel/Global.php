<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		EasyDev
 * @subpackage	Kernel/Global
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

/*
|----- Load requested class -----
*/
if (!function_exists('loadClass'))
{
	function &loadClass($file, $class, $objName = '', $dir = 'libraries')
	{
		static $classes = array();
		
		$objName = ($objName == '') ? $class : $objName;
		$dir = trim($dir);
		
		if (isset($classes[$objName]))
		{
			return $classes[$objName];
		}
		
		$_found = FALSE;
		
		foreach (array(APPPATH, SYSPATH) as $path)
		{
			if (file_exists($path.$dir.'/'.$file.'.php'))
			{				
				if (!class_exists($class))
				{
					require($path.$dir.'/'.$file.'.php');
				}
				$_found = TRUE;
				break;
			}
		}
		
		if ($_found === FALSE)
		{
			exit('Unable to locate the specified class: '.$file.'.php');
		}
		
		isLoadedClass($objName);
		
		$classes[$objName] = new $class();
		
		return $classes[$objName];
	}
}

/*
|----- Return loaded classes instance -----
*/
if (!function_exists('isLoadedClass'))
{
	function &isLoadedClass($class = '')
	{
		static $isLoadedClass = array();
		
		if ($class != '')
		{
			$isLoadedClass[strtolower($class)] = $class;
		}
		
		return $isLoadedClass;
	}
}

if (!function_exists('buildSuperObject'))
{
	function buildSuperObject()
	{
		require_once(SYSPATH.'kernel/SuperObject.php');
		
		$EDSuperObject = new ED_SuperObject();
	}
}

if (!function_exists('getObjectInstance'))
{
	function &getObjectInstance()
	{
		return ED_SuperObject::getObjectInstance();
	}
}

/*
|----- Get a item from config array -----
*/
if (!function_exists('getConfigItem'))
{
	function getConfigItem($item)
	{
		static $configItems = array();
		
		if (isset($configItems[$item]))
		{
			return $configItems[$item];
		}
		
		$_tempConfig =& loadClass('Config', 'ED_Config', '', 'kernel');
		
		if (isset($_tempConfig->_config) AND is_array($_tempConfig->_config))
		{
			foreach ($_tempConfig->_config as $key => $val)
			{
				if (!isset($configItems[$key]))
				{
					$configItems[$key] = $val;
				}
			}
		}
		
		if (isset($configItems[$item]))
		{
			return $configItems[$item];
		}
		else
		{
			return FALSE;
		}
	}
}

/*
|----- Set a item to config array  -----
*/
if (!function_exists('setConfigItem'))
{
	function setConfigItem($item, $val)
	{
		$_tempConfig =& loadClass('Config', 'ED_Config', '', 'config');
		
		if (isset($_tempConfig[$item]))
		{
			$_tempConfig[$item] = $val;
		}
	}
}

/*
|----- Fetch site url -----
*/
if (!function_exists('getSiteUrl'))
{
	function getSiteUrl($uri = '')
	{
		if ($uri == '')
		{
			$tempUrl = rtrim(getConfigItem('baseUrl'), '/').'/';
			$tempUrl .= (getConfigItem('setIndexPage') == TRUE) ? getConfigItem('indexPage') : '';
			return $tempUrl;
		}
		else
		{
			$tempUrl = rtrim(getConfigItem('baseUrl'), '/').'/';
			$tempUrl .= (getConfigItem('setIndexPage') == TRUE) ? getConfigItem('indexPage').'/' : '';
			$tempUrl .= makeUriString($uri);
			return $tempUrl;
		}
	}
}

/*
|----- Fetch base url -----
*/
if (!function_exists('getBaseUrl'))
{
	function getBaseUrl($uri = '')
	{
		if ($uri == '')
		{
			return rtrim(getConfigItem('baseUrl'), '/').'/';
		}
		else
		{
			$tempUrl = rtrim(getConfigItem('baseUrl'), '/').'/';
			$tempUrl .= (getConfigItem('setIndexPage') == TRUE) ? getConfigItem('indexPage').'/' : '';
			$tempUrl .= makeUriString($uri);
			return $tempUrl;
		}
	}
}

/*
|----- Make uri string from $uri array -----
*/
if (!function_exists('makeUriString'))
{
	function makeUriString($uri)
	{
		if (is_array($uri))
		{
			if (getConfigItem('switchToQueryString') === FALSE)
			{
				return trim(implode('/', $uri), '/');
			}
			else
			{
				$counter = 0;
				$uriString = '';
				
				foreach($uri as $key => $val)
				{
					$prefix = ($counter == 0) ? '' : '&';
					$uriString .= $prefix.$key.'='.$val;
					$counter++;
				}
				return $uriString;
			}		
		}
	}
}

/*
|----- Fetch requested language -----
*/
if (!function_exists('lang'))
{
	function lang($line)
	{
		$__lang =& loadClass('Language', 'ED_Language', 'lang');
		return $__lang->get($line);
	}
}

/*
|----- Replace spaces with dash -----
*/
if (!function_exists('stod'))
{
	function stod($val)
	{
		$val = str_replace(' ', '-', $val);
		return $val;
	}
}

/*
|----- Error Handler - template located in app/errors/error.php -----
*/
if (!function_exists('error'))
{
	function error($heading = 'An error was encountered', $msg, $type = 500, $logError = TRUE)
	{
		$err =& loadClass('ErrorHandling', 'ED_ErrorHandling');
		$err->show($heading, $msg, $type, $logError);
		exit;
	}
}

/*
|----- 404 Error Handler - template located in app/errors/error_404.php -----
*/
if (!function_exists('error_404'))
{
	function error_404($page = '', $logError = TRUE)
	{
		$err =& loadClass('ErrorHandling', 'ED_ErrorHandling');
		$err->show_404($page, $logError);
		exit;
	}
}

/*
|----- Error logging interface -----
*/
if (!function_exists('writeLog'))
{
	function writeLog($heading, $msg)
	{
		$_log =& loadClass('Log', 'ED_Log', 'log');
		$_log->write($heading, $msg);
	}
}

/*
|----- Remove filtered characters from string -----
*/
if (!function_exists('removeFilteredChars'))
{
	function removeFilteredChars($str, $encoded = TRUE)
	{
		$pattern = array();
		
		if ($encoded)
		{
			// 00-08, 11, 12, 14, 15 is filtered characters.
			// Tab 09, Newline 10 and Carriage return 13 is non-filtered characters
			$pattern[] = '/%0[0-8bcef]/';
			$pattern[] = '/%1[0-9a-f]/';
		}
		
		$pattern[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';

		do
		{
			$str = preg_replace($pattern, '', $str, -1, $count);
		}
		while ($count);
		
		return $str;
	}
}

?>