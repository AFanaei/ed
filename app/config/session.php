<?php

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *	-- Session configuration
 * @package		EasyDev
 * @subpackage	Config/Session
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

/*
|----- Session related variables -----
*/
$sessionConf['sessPrefix'] = 'raya_';

/*
|----- Cross Site Request Forgery -----
*/
$sessionConf['csrfProtection'] = TRUE;
$sessionConf['csrfTokenName'] = '';
$sessionConf['csrfCookieName'] = '';
$sessionConf['csrfExpire'] = '';

?>