<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *	-- Manage user cookies
 * @package		EasyDev
 * @subpackage	Libraries/Cookie
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class ED_Cookie
{

	var $_prefix = '';
	var $_expire = 0;
	var $_path = '/';
	var $_domain = '';
	var $_secure = FALSE;
	var $_httpOnly = TRUE;
	
	/*
	|----- Cookie class constructor -----
	*/
	function __construct()
	{
		if (file_exists(APPPATH.'config/cookie.php'))
		{
			include(APPPATH.'config/cookie.php');
						
			$this->_prefix = (isset($cookieConf['prefix'])) ? $cookieConf['prefix'] : '';
			$this->_expire = (isset($cookieConf['expire'])) ? $cookieConf['expire'] : 0;
			$this->_path = (isset($cookieConf['path'])) ? $cookieConf['path'] : '/';
			$this->_domain = (isset($cookieConf['domain'])) ? $cookieConf['domain'] : '';
			$this->_secure = (isset($cookieConf['secure'])) ? $cookieConf['secure'] : FALSE;
			$this->_httpOnly = (isset($cookieConf['httpOnly'])) ? $cookieConf['httpOnly'] : TRUE;
			
			$this->_security =& loadClass('Security', 'ED_Security', 'security');
			writeLog('Debug', 'Cookie configuration initialized.');
		}
		else
		{
			error('Debug', 'Cookie configuration does not found.');
		}
		
		writeLog('Debug', 'Cookie class initialized.');
	}
	
	/*
	|----- Create cookie -----
	*/
	public function create($name, $value, $expire = NULL, $path = NULL, $domain = NULL, $secure = NULL, $httpOnly = NULL)
	{
		$expire = (($expire != NULL) && is_int($expire)) ? time() + $expire : time() + $this->_expire;
		$path = ($path != NULL) ? $path : $this->_path;
		$domain = ($domain != NULL) ? $domain : $this->_domain;
		$secure = ($secure != NULL) ? $secure : $this->_secure;
		$httpOnly = ($httpOnly != NULL) ? $httpOnly : $this->_httpOnly;
		
		return setcookie($this->_prefix.$name, $value, $expire, $path, $domain, $secure, $httpOnly);
	}
	
	/*
	|----- Delete exists cookie -----
	*/
	public function delete($name)
	{
		return setcookie($this->_prefix.$name, '', time() - 3600);
	}
	
	/*
	|----- Return exists cookie -----
	*/
	public function get($name, $safeMode = NULL)
	{
		if (!isset($name) OR $name == '')
		{
			return FALSE;
		}
		
		$name = $this->_prefix.$name;
		
		$safeMode = ($safeMode === NULL) ? getConfigItem('safeMode') : $safeMode;
		
		if (isset($_COOKIE[$name]))
		{
			if ($safeMode === TRUE)
			{
				return $this->_security->xssSafe($_COOKIE[$name]);
			}
			
			return $_COOKIE[$name];
		}
		
		return FALSE;
	}
}

?>