<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *	-- Create captcha images using reCaptcha API
 * @package		EasyDev
 * @subpackage	Libraries/reCaptcha
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class ED_reCaptcha
{

	function __construct()
	{
		if (file_exists(APPPATH.'config/recaptcha.php') AND file_exists(SYSPATH.'libraries/recaptchalib.php')
		{
			include(APPPATH.'config/recaptcha.php');
			require_once(SYSPATH.'libraries/recaptchalib.php');
			
			writeLog('Debug', 'reCaptcha class initialized.');
		}
		else
		{
			writeLog('Error', 'reCaptcha class was not initialized.');
		}
	}
	
	public function getCaptcha()
	{		
		echo recaptcha_get_html($keys['public']);
	}
	
	public function isValid()
	{
		$resp = recaptcha_check_answer ($keys['private'], $_SERVER["REMOTE_ADDR"],
			$_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

		if (!$resp->is_valid)
		{
			return FALSE;
		} 
		else
		{
			return TRUE;
		}
	}
}

?>