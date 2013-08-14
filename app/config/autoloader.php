<?php

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *	-- Auto loader configuration
 * @package		EasyDev
 * @subpackage	Config/AutoLoader
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

/*
|----- Auto-load files -----

Prototype:
		$auto['libraries'] = array('file name', 'class name', 'object name', 'location');
		
		'file name' => file name without extension.
		'class name' => Class name.
		'object name' => an instance of class named 'object name'.
		'location' => file location by default in library.
*/

$auto['libraries'] = array( array('PDO', 'ED_PDO', 'pdo'),
							array('Doctrine', 'Doctrine', 'doc'),
							array('Input', 'ED_Input', 'input'),
							array('Output', 'ED_Output', 'output'),
							array('Security', 'ED_Security', 'security'),
							array('Cookie', 'ED_Cookie', 'cookie'),
							array('Session', 'ED_Session', 'session'));

?>							