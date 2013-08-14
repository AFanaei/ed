<?php

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *	-- Database configuration
 * @package		EasyDev
 * @subpackage	Config/DB
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

/*
|----- Database connection info -----
*/
$dbConf['hostname'] = '127.0.0.1';
$dbConf['username'] = 'root';
$dbConf['password'] = '';
$dbConf['dbname'] = 'ed';

/*
|----- Database driver -----
	Supported drivers: PqSql, SQLite, MySql, Firebird, Oracle, ODBC(not working yet), DBLIB;
*/
$dbConf['driver'] = 'pdo_mysql';

/*
|----- Database connection configuration -----
*/
$dbConf['dbprefix'] = '';
$dbConf['pconnect'] = '';
$dbConf['debug'] = '';
$dbConf['charset'] = 'utf-8';
$dbConf['collation'] = '';

?>
