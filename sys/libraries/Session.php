<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *	-- Manage user sessions
 * @package		EasyDev
 * @subpackage	Libraries/Session
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class ED_Session
{
	/*
	|----- Store session configuration -----
	*/
	var $_conf = array();
	
	function __construct()
	{
		if (file_exists(APPPATH.'config/session.php'))
		{
			require_once(APPPATH.'config/session.php');
			
			if (isset($sessionConf) AND is_array($sessionConf))
			{
				$_conf = $sessionConf;
				
				unset($sessionConf);
				
				session_start();
				
				$this->security =& loadClass('Security', 'ED_Security', 'security');
		
				writeLog('Debug', 'Session class initialized.');
			}
			else
			{
				writeLog('Error', 'Invalid session configuration file');
			}
		}
		else
		{
			writeLog('Error', 'Session configuration file does not exist.');
		}
	}
	
	/*
	|----- Create session -----
	*/
	public function create($name, $data, $safeMode = FALSE)
	{
		if (!isset($_SESSION[$name]))
		{
			$name = (isset($_conf['sessPrefix']) AND $_conf['sessPrefix'] != '') ? $_conf['sessPrefix'].$name : $name;
			$_SESSION[$name] = ($safeMode) ? $this->security->xssSafe($data) : $data;
			return TRUE;
		}
		else
		{
			return $this->update($name, $data, $safeMode);
		}
	}
	
	/*
	|----- Update exists session -----
	*/
	public function update($name, $data, $safeMode = FALSE)
	{
		if (isset($_SESSION[$name]))
		{
			$name = (isset($_conf['sessPrefix']) AND $_conf['sessPrefix'] != '') ? $_conf['sessPrefix'].$name : $name;
			$_SESSION[$name] = ($safeMode) ? $this->security->xssSafe($data) : $data;
			return TRUE;
		}
		
		return FALSE;
	}
	
	/*
	|----- Remove a session -----
	*/
	public function delete($name)
	{
		$name = (isset($_conf['sessPrefix']) AND $_conf['sessPrefix'] != '') ? $_conf['sessPrefix'].$name : $name;
		
		if (isset($_SESSION[$name]))
		{
			unset($_SESSION[$name]);
			return TRUE;
		}
		
		return FALSE;
	}
	
	/*
	|----- Remove all sessions -----
	*/
	public function removeAll()
	{
		session_destroy();
	}
	
	/*
	|----- Get session -----
	*/
	public function get($name, $safeMode = FALSE)
	{
		$name = (isset($_conf['sessPrefix']) AND $_conf['sessPrefix'] != '') ? $_conf['sessPrefix'].$name : $name;
		
		if (isset($_SESSION[$name]))
		{
			return ($safeMode) ? $this->security->xssSafe($_SESSION[$name]) : $_SESSION[$name];
		}
		
		return FALSE;
	}

}

?>