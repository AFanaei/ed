<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *	-- Parses URIs and determines routing
 *
 * @package		EasyDev
 * @subpackage	Kernel/Uri
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class ED_Uri
{
	var $uriString = '';
	
	var $splittedUriString = array();
	
	function __construct()
	{
		$this->fetchUriString();
		writeLog('Debug', 'Uri class initialized.');
	}
	
	/*
	|----- Get the uri string -----
	*/
	public function fetchUriString()
	{
		if ($_tempUri = $this->getUriFromRequest())
		{
			$this->set(trim($_tempUri, '/'));
		}
		
		return;
	}
	
	/*
	|----- Set the uri string -----
	*/
	public function set($str)
	{		
		$str = removeFilteredChars($str, FAlSE);
		
		$this->uriString = ($str == '/') ? '' : $str;
	}
	
	/*
	|----- Fetch the uri string from SuperGlobal $_SERVER variable -----
	*/
	private function getUriFromRequest()
	{
		if (!isset($_SERVER['REQUEST_URI']) OR !isset($_SERVER['SCRIPT_NAME']))
		{
			return FALSE;
		}
		
		$_tempUri = $_SERVER['REQUEST_URI'];
		if (strpos($_tempUri, $_SERVER['SCRIPT_NAME']) === 0)
		{
			$_tempUri = substr($_tempUri, strlen($_SERVER['SCRIPT_NAME']) + 1);
		}
		
		if ($_tempUri == '/' OR empty($_tempUri))
		{
			return '/';
		}
		
		return $_tempUri;
	}
	
	/*
	|----- Split the uri string -----
	*/
	public function splitUri()
	{
		if ($this->uriString != '')
		{
			if (getConfigItem('switchToQueryString') == FALSE)
			{
				$_tempVal = explode('/', $this->uriString);

				foreach ($_tempVal as $val)
				{
					$val = $this->validateUri($val);
					
					if ($val != '')
					{
						$this->splittedUriString[] = $val;
					}
				}
				
				return;
			}
		}
		
		return;
	}
	
	/*
	|----- Validate splitted uri for disallowed characters -----
	*/
	public function validateUri($str)
	{
		if (getConfigItem('allowedUriChars') != '' && getConfigItem('switchToQueryString') == FALSE && $str != '')
		{
			if (!preg_match("|^[".getConfigItem('allowedUriChars')."]+$|i", $str, $matches))
			{
				error('Invalid uri value', 'The URI you submitted has disallowed characters.');
			}
		}
		
		// Convert programatic characters to entities - From CI
		$bad	= array('$',		'(',		')',		'%28',		'%29');
		$good	= array('&#36;',	'&#40;',	'&#41;',	'&#40;',	'&#41;');
		
		return str_replace($bad, $good, $str);
	}
}