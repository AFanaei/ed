<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
* EasyDev
*
* An open source application development framework for PHP 5.1.6 or newer
*
* @package		EasyDev
* @subpackage	DB/PDO
* @Developer	Hassan nasiri
* @copyright	Copyright (c) 2013, Hassan nasiri
* @license		http://www.gnu.org/licenses/gpl.html
* @website		---
* @since		Version 1.0
*/

// ------------------------------------------------------------------------

class Doctrine{
	public $entityManager;
	public $_conf = array();
	/*
	|----- Constructor -----
	*/
	public function __construct()
	{
		require_once SYSPATH."doctrine2-master/vendor/autoload.php";
		if (file_exists(APPPATH.'config/db.php'))
		{
			require_once(APPPATH.'config/db.php');
			writeLog('Debug', 'PDO configuration file included.');
			if (isset($dbConf) AND is_array($dbConf))
			{
				$this->_conf = $dbConf;				
			}
			else
			{
				writeLog('Debug', 'PDO->configuration: invalid configuration file.');
				return FALSE;
			}
		}
		else
		{
			writeLog('Debug', 'PDO->configuration: file does not exists.');
			return FALSE;
		}
		$paths = array(APPPATH."/doctrine");
		$isDevMode = true;

		$dbParams = array(
		'driver'   => $_Conf['driver'],
		'user'     => $_Conf['username'],
		'password' => $_Conf['password'],
		'dbname'   => $_Conf['driver'],
		);

		$config = Setup::createYAMLMetadataConfiguration($paths, $isDevMode);
		$this->entityManager = EntityManager::create($dbParams, $config);
	}
}
?>
