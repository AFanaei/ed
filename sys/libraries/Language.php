<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *	-- Input functions
 * @package		EasyDev
 * @subpackage	Libraries/Input
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class ED_Language
{
	/*
	|----- Language file items -----
	*/
	public $lang = array();
	
	/*
	|----- Store current language filename -----
	*/
	private $cLang = '';
	
	/*
	|----- Language class constructor -----
	*/
	function __construct()
	{
		writeLog('Debug', 'Language class initialized.');
	}
	
	/*
	|----- Load requested language file -----
	*/
	public function load($param)
	{
		if (isset($this->lang[$param]))
		{
			return TRUE;
		}
		
		$seg = explode(':', $param);
		
		if (count($seg) == 1)
		{
//			$_seg = (isset(getConfigItem('language')) AND getConfigItem('language') != '') ? array(getConfigItem('language'), $seg[0]) : '';
		}
		
		if (count($seg) == 2)
		{
			$seg[0] = trim($seg[0], '/');
			$seg[1] = trim($seg[1], '/');
			
			if (file_exists(APPPATH.'language/'.$seg[0].'/'.$seg[1].'.php'))
			{
				include_once(APPPATH.'language/'.$seg[0].'/'.$seg[1].'.php');
				
				if (isset($lang) AND is_array($lang))
				{
					$this->lang[$param] = $lang;
					
					$this->cLang = $param;
					writeLog('Debug', ' Language file loaded: '.$seg[0].'/'.$seg[1]);
					
					return TRUE;
				}
				else
				{
					writeLog('Debug', 'Invalid language file: '.$seg[0].'/'.$seg[1]);
					
					return FALSE;
				}
			}
			else
			{
				error(NULL, 'Unable to load', $seg[0].'/'.$seg[1].' language does not exist.');
			}
		}
		else
		{
			error(NULL, 'Unable to load the requested language file: '.$param);
		}
	}
	
	/*
	|----- Return requested line -----
	*/
	public function get($param)
	{
		if ($this->cLang != '' AND $this->cLang != NULL)
		{
			foreach ($this->lang[$cLang] as $arr)
			{
				if (isset($arr[$param]))
				{
					return $arr[$param];
				}
			}
		}
		
		writeLog('Error', 'Could not find the language line in: '.$this->cLang.'/'.$param);
		
		return FALSE;
	}
}

?>