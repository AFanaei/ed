<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *	-- Security functions
 * @package		EasyDev
 * @subpackage	Libraries/Security
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class ED_Security
{
	
	/*
	|----- Security configuration array -----
	*/
	var $_secConf = array();
	
	/*
	|----- Security class constructor -----
	*/
	function __construct()
	{
		if (file_exists(APPPATH.'config/security.php'))
		{
			include(APPPATH.'config/security.php');
			
			$this->_secConf = (isset($securityConf) AND is_array($securityConf)) ? $securityConf : NULL;
			
			if ($this->_secConf == NULL)
			{
				writeLog('Error', 'Invalid security configuration file.');
			}
		}
		else
		{
			writeLog('Debug', 'Security configuration does not exists.');
		}
		
		writeLog('Debug', 'Security class initialized.');
	}
	
	/*
	|----- Escape html characters -----
	*/
	public function xssSafe($data, $encode = '')
	{
		$encode = ($encode != '') ? $encode : getConfigItem('charset');
		return htmlspecialchars($data, ENT_HTML401 | ENT_QUOTES, $encode);
	}
	
	/*
	|----- Create random token for csrf -----
	*/
	public function createCsrfToken($name)
	{
		if (isset($this->_secConf['csrf_token_prefix']) AND isset($this->_secConf['csrf_token_onetime']))
		{				
			$sess =& loadClass('Session', 'ED_Session', 'session');
			
			$token = md5(mt_rand(1000, 1000000) + time());
			
			if ($sess->create($this->_secConf['csrf_token_prefix'].$name, $token))
			{
				return $token;
			}
			
			return FALSE;
		}
		
		return FALSE;
	}
	
	/*
	|----- Validate csrf token -----
	*/
	public function validateCsrfToken($name, $token, $isonetime = NULL)
	{
		if (isset($this->_secConf['csrf_token_prefix']) AND isset($this->_secConf['csrf_token_onetime']))
		{
			$isonetime = ($isonetime == NULL) ? $this->_secConf['csrf_token_onetime'] : $isonetime;
			
			$sess =& loadClass('Session', 'ED_Session', 'session');
			
			if ($sess->get($this->_secConf['csrf_token_prefix'].$name) == $token)
			{
				return TRUE;
			}
			
			return FALSE;
		}
		
		return FALSE;
	}
	
	/*
	|----- Hash data -----
	*/
	public function hash($algorithm, $data, $rawOutput = FALSE)
	{
		$algos = array('md4', 'md5', 'crc32b', 'crc32', 'sha1', 'tiger128,3', 'haval192,3', 'haval224,3', 'tiger160,3', 'haval160,3',
						'haval256,3', 'tiger192,3', 'haval128,3', 'tiger192,4', 'tiger128,4', 'tiger160,4', 'haval160,4', 'haval192,4',
						'haval256,4', 'adler32', 'haval128,4', 'haval224,4', 'ripemd256', 'haval160,5', 'haval128,5', 'haval224,5',
						'haval195,5', 'haval256,5', 'sha256', 'ripemd128', 'ripemd160', 'ripemd320', 'sha384', 'sha512', 'gost',
						'whirlpool', 'snefru', 'md2');
		
		$algorithm = (in_array($algorithm, $algos)) ? $algorithm : FALSE;
		
		return ($algorithm != FALSE) ? hash($algorithm, $data, $rawOutput) : FALSE;
	}
	
	public function encrypt($data, $key)
	{
		// coming soon
	}
	
	public function decrypt($data, $key)
	{
		// coming soon
	}
}

?>