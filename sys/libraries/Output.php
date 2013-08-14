<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *	-- Responsible for sending final output to browser
 * @package		EasyDev
 * @subpackage	Libraries/Output
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class ED_Output
{

	/*
	|----- Current output string -----
	*/
	private $output;
	
	/*
	|----- Current compression status -----
	*/
	private $zlib = FALSE;
	
	/*
	|----- Output class constructor -----
	*/
	function __construct()
	{
		ob_start();
		if (@ini_get('zlib.output_compression'))
		{
			//$this->zlib = (isset(getConfigItem('enableCompression')) AND getConfigItem('enableCompression') == TRUE) ? TRUE : FALSE;
		}
		
		writeLog('Debug', 'Output class initialized.');
	}
	
	/*
	|----- Append data to output string -----
	*/
	public function append($data)
	{
		$this->output .= $data;
	}
	
	/*
	|----- Clear data from output string -----
	*/
	public function clear()
	{
		$this->output = '';
	}
	
	/*
	|----- Send final data to browser -----
	*/
	public function send()
	{
		echo $this->output;
	}	
}

?>