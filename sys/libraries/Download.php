<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *	-- Force download to happen
 * @package		EasyDev
 * @subpackage	Libraries/Download
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class ED_Download
{

	/*
	|----- Download class constructor -----
	*/
	function __construct()
	{
		writeLog('Debug', 'Download class initialized.');
	}
	
	/*
	|----- Force download to happen -----
	*/
	public function Force($fileName = '', $data = '')
	{
		if ($fileName == '' OR $data == '')
		{
			return FALSE;
		}
		
		if (strpos($fileName, '.') === FALSE)
		{
			return FALSE
		}
		
		$ext = explode('.', $fileName);
		$ext = end($ext);
		
		if (file_exists(APPPATH.'config/mimes.php'))
		{
			include(APPPATH.'config/mimes.php');
		}
		
		if ( ! isset($mimes[$ext]))
		{
			$mime = 'application/octet-stream';
		}
		else
		{
			$mime = (is_array($mimes[$ext])) ? $mimes[$ext][0] : $mimes[$ext];
		}
		
		if (strpos($_SERVER['HTTP_USER_AGENT'], "MSIE") !== FALSE)
		{
			header('Content-Type: "'.$mime.'"');
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header("Content-Transfer-Encoding: binary");
			header('Pragma: public');
			header("Content-Length: ".strlen($data));
		}
		else
		{
			header('Content-Type: "'.$mime.'"');
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			header("Content-Transfer-Encoding: binary");
			header('Expires: 0');
			header('Pragma: no-cache');
			header("Content-Length: ".strlen($data));
		}

		exit($data);
	}
}

?>