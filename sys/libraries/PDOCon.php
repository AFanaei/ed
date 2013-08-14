<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
* EasyDev
*
* An open source application development framework for PHP 5.1.6 or newer
*
* @package		EasyDev
* @subpackage	DB/PDOCon
* @Developer	Hassan nasiri
* @copyright	Copyright (c) 2013, Hassan nasiri
* @license		http://www.gnu.org/licenses/gpl.html
* @website		---
* @since		Version 1.0
*/

// ------------------------------------------------------------------------

class PDOCon
{
	var $_conf = array();
	
	var $_con = NULL;
	
	/*
	|----- Database connection constructor -----
	*/
	function __construct()
	{
		if (file_exists(APPPATH.'config/db.php'))
		{
			require_once(APPPATH.'config/db.php');
			writeLog('Debug', 'PDO configuration file included.');
			
			if (isset($dbConf) AND is_array($dbConf))
			{
				$this->_conf = $dbConf;				
				$this->_conf['driver'] = 'mysql';
				return $this->init();
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
	}
	
	/*
	|----- Initialized connection and call user defined database driver -----
	*/
	private function init()
	{
		if (isset($this->_conf['driver']) AND $this->_conf['driver'] != '')
		{
			if (in_array(strtolower($this->_conf['driver']), array_map('strtolower', get_class_methods($this))))
			{
				$retval = call_user_func(array($this, strtolower($this->_conf['driver'])));
				
				$this->charset();
				
				if (isset($this->_conf['debug']) AND $this->_conf['debug'] == TRUE)
				{
					$this->_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				}
				
				writeLog('Debug', 'PDO class initialized.');
				
				return $retval;
			}		
		}
		else
		{
			writeLog('Debug', 'PDO->driver: driver value cannot be null or empty.');
			
			return FALSE;
		}
	}
	
	/*
	|----- Create connection for PgSql database -----
	*/
	private function pgsql()
	{
		if (isset($this->_conf['dbname']) AND $this->_conf['dbname'] != ''
			AND isset($this->_conf['hostname']) AND $this->_conf['hostname'] != '')
		{
			try
			{
				$this->_con = new PDO('pgsql:dbname='.$this->_conf['dbname'].';host='.$this->_conf['hostname'], $this->_conf['username'], $this->_conf['password']);
				
				return TRUE;
			}
			catch(PDOException $ex)
			{
				if (isset($this->_conf['debug']) AND $this->_conf['debug'] == TRUE)
				{
					error('PDOCON->PgSql', $ex->getMessage(), 500, TRUE);
				}
				
				writeLog('Error', $ex->getMessage());
				return FALSE;
			}
		}
		else
		{
			writeLog('Error', "PDOCON->PgSql: Invalid 'database name' or 'host name'");
			
			return FALSE;
		}
	}
	
	/*
	|----- Create connection for PgSql SQLite -----
	*/
	private function sqlite()
	{
		if (isset($this->_conf['dbname']) AND $this->_conf['dbname'] != '')
		{
			try
			{
				$this->_con = new PDO('sqlite:'.$this->_conf['dbname']);
				
				return TRUE;
			}
			catch(PDOException $ex)
			{
				if (isset($this->_conf['debug']) AND $this->_conf['debug'] == TRUE)
				{
					error('PDOCON->SQLite', $ex->getMessage(), 500, TRUE);
				}
				
				writeLog('Error', $ex->getMessage());
				return FALSE;
			}
		}
		else
		{
			writeLog('Error', "PDOCON->SQLite: Invalid 'database name'");
			
			return FALSE;
		}
	}
	
	/*
	|----- Create connection for MySql database -----
	*/
	private function mysql()
	{
		if (isset($this->_conf['dbname']) AND $this->_conf['dbname'] != ''
			AND isset($this->_conf['hostname']) AND $this->_conf['hostname'] != '')
		{
			try
			{
				$this->_con = new PDO('mysql:host='.$this->_conf['hostname'].';dbname='.$this->_conf['dbname'], $this->_conf['username'], $this->_conf['password']);
				
				return TRUE;
			}
			catch(PDOException $ex)
			{
				if (isset($this->_conf['debug']) AND $this->_conf['debug'] == TRUE)
				{
					error('PDOCON->MySql', $ex->getMessage(), 500, TRUE);
				}
				
				writeLog('Error', $ex->getMessage());
				return FALSE;
			}
		}
		else
		{
			writeLog('Error', "PDOCON->MySql: Invalid 'database name' or 'host name'");
			
			return FALSE;
		}
	}
	
	/*
	|----- Create connection for Firebird database -----
	*/
	private function firebird()
	{
		if (isset($this->_conf['dbname']) AND $this->_conf['dbname'] != '')
		{
			try
			{
				$this->_con = new PDO('firebird:dbname='.$this->_conf['dbname'], $this->_conf['username'], $this->_conf['password']);
				
				return TRUE;
			}
			catch(PDOException $ex)
			{
				if (isset($this->_conf['debug']) AND $this->_conf['debug'] == TRUE)
				{
					error('PDOCON->FireBird', $ex->getMessage(), 500, TRUE);
				}
				
				writeLog('Error', $ex->getMessage());
				return FALSE;
			}
		}
		else
		{
			writeLog('Error', "PDOCON->FireBird: Invalid 'database name'");
			
			return FALSE;
		}
	}
	
	/*
	|----- Create connection for Oracle database -----
	*/
	private function oracle()
	{
		if (isset($this->_conf['dbname']) AND $this->_conf['dbname'] != '')
		{
			try
			{
				$this->_con = new PDO('OCI:dbname='.$this->_conf['dbname'].';charset=UTF-8', $this->_conf['username'], $this->_conf['password']);
				
				return TRUE;
			}
			catch(PDOException $ex)
			{
				if (isset($this->_conf['debug']) AND $this->_conf['debug'] == TRUE)
				{
					error('PDOCON->Oracle', $ex->getMessage(), 500, TRUE);
				}
				
				writeLog('Error', $ex->getMessage());
				return FALSE;
			}
		}
		else
		{
			writeLog('Error', "PDOCON->Oracle: Invalid 'database name' or 'host name'");
			
			return FALSE;
		}
	}
	
	/*
	|----- Create connection for ODBC database (not supported yet) -----
	*/
	private function odbc()
	{
		return FALSE;
	}
	
	/*
	|----- Set connection charset and collation -----
	*/
	private function charset()
	{
		if (isset($this->_conf['charset']) AND $this->_conf['charset'] != '')
		{
			if (isset($this->_conf['collation']) AND $this->_conf['collation'] != '')
			{
				$this->_con->exec('SET NAMES '.$this->_conf['charset'].' COLLATE '.$this->_conf['collation']);
			}
			else
			{
				$this->_con->exec('SET NAMES '.$this->_conf['charset']);
			}
		}
	}
	
	/*
	|----- Close connection -----
	*/
	public function disconnect()
	{
		$this->_con = FALSE;
		
		return TRUE;
	}
}

?>