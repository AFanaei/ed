<?php

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *	-- Security configuration
 * @package		EasyDev
 * @subpackage	Config/Security
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

/*
|----- Encryption Key (32BIT) -----
*/
$securityConf['encryptionKey'] = '';

/*
|----- Safe input using html escaping -----
*/
$securityConf['safeMode'] = TRUE;

/*
|----- CSRF token prefix -----
*/
$securityConf['csrt_token_prefix'] = 'ed_csrf_token_';

/*
|----- Do you want make one-time token? -----
*/
$securityConf['csrf_token_onetime'] = TRUE;

?>