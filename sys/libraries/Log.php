<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *	-- Logging handler, write debug and error logs to file
 * @package		EasyDev
 * @subpackage	Libraries/Log
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class ED_Log
{
	var $logging = TRUE;
	var $path = 'logs';
	var $logDateFormat = 'm-d-Y H:i:s';
	
	/*
	|----- Log class constructor -----
	*/
	function __construct()
	{
		if (file_exists(APPPATH.'config/log.php'))
		{
			require_once(APPPATH.'config/log.php');
			
			$this->logging = (isset($logConf['logging'])) ? $logConf['logging'] : TRUE;
			
			$this->path = (isset($logConf['path']) AND $logConf['path'] != '') ? $logConf['path'] : 'logs';
			$this->path = trim($this->path, '/').'/';
			$this->path = APPPATH.$this->path;
			
			$this->logging = (is_dir($this->path)) ? $this->logging : FALSE;

			$this->logDateFormat = (isset($logConf['logDateFormat']) AND $logConf['logDateFormat'] != '') ? $logConf['logDateFormat'] : 'Y-m-d H:i:s';
		}
	}
	
	/*
	|----- Write logs to file -----
	*/
	public function write($heading, $msg)
	{
		if (! $this->logging)
		{
			return FALSE;
		}
		
		$fileName = $this->path.'Log-'.date('m-d-Y').'.php';

		$_temp = '';

		if (!file_exists($fileName))
		{
			$_temp = "<?php if (!defined(SYSPATH)) { require(SYSPATH.'kernel/AccessDenied.php'); exit; } ?>\n\n\n";
		}
		
		if (! $fp = @fopen($fileName, 'ab'))
		{
			return FALSE;
		}
		
		$_temp .= date($this->logDateFormat).'( '.$heading.' ) ===> '.$msg."\n";
		
		flock($fp, LOCK_EX);
		fwrite($fp, $_temp);
		flock($fp, LOCK_UN);
		fclose($fp);
		
		return TRUE;
		
	}
}

?>