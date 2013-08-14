<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *	-- Handel errors
 * @package		EasyDev
 * @subpackage	Libraries/ErrorHandling
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class ED_ErrorHandling
{
	var $config;
	
	/*
	|----- ErrorHandling class constructor -----
	*/
	function __construct()
	{
		$log =& loadClass('Log', 'ED_Log', 'log');
	}
	
	/*
	|----- Terminate current proccess and show error message -----
	*/
	public function show($heading, $msg, $type, $logError = TRUE)
	{
		if (file_exists(APPPATH.'errors/errors.php'))
		{
			include(APPPATH.'errors/errors.php');
		}
		
		if($logError)
		{
			writeLog($heading, $msg);
		}
		
		exit;
	}
	
	/*
	|----- Terminate current proccess and redirect user to '404 page not found' page -----
	*/
	public function show_404($page = '', $logError = TRUE)
	{
		if (file_exists(APPPATH.'errors/error_404.php'))
		{
			include(APPPATH.'errors/error_404.php');
		}
		
		if($logError)
		{
			writeLog($page, '404 Page not found');
		}
		
		exit;
	}

}

?>