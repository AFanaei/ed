<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

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

class ED_PDO
{
	/*
	|----- PDO connection holder -----
	*/
	var $con = NULL;
	
	/*
	|----- PDO constructor -----
	*/
	function __construct()
	{
		if (file_exists(SYSPATH.'db/PDOCon.php'))
		{
			require_once(SYSPATH.'db/PDOCon.php');
			
			if (class_exists('PDOCon'))
			{
				$temp = new PDOCon();
				
				$this->con = $temp->_con;
				
				unset($temp);
			}
			else
			{
				error('PDO->PDOCon:', 'PDOCon class does not exists.');
			}
		}
		else
		{
			error('PDO->PDOCon:', 'PDOCon file does not exists.');
		}
	}
	
	/*
	|----- Create 'select' statement -----
	*/
	public function select($table, $cols, $wheres = NULL, $whereOp = 'AND')
	{
		if ($table == NULL OR $table == '')
		{
			writeLog('Error', 'table value cannot be null or empty in PDO->select');
			return FALSE;
		}
		
		if (!is_array($cols) OR count($cols) < 1)
		{
			writeLog('Error', 'columns value cannot be null or empty in PDO->select');
			return FALSE;
		}
		
		$temp = 'SELECT ';
		
		foreach ($cols as $key)
		{
			if ($key == '' OR preg_match('|^(\s)+$|', $key))
			{
				writeLog('Error', 'columns value cannot be null or empty in PDO->select->columns');
				return FALSE;
			}
			
			$temp .= $key.', ';
		}
		
		$temp = rtrim($temp, ', ');
		
		$temp .= ' FROM '.$table;
		
		if (is_array($wheres) AND count($wheres) > 0)
		{
			$temp .= ' WHERE ';
			
			foreach ($wheres as $key => $val)
			{
				if ($key == '' OR preg_match('|^(\s)+$|', $key))
				{
					writeLog('Error', 'columns value cannot be null or empty in PDO->select->wheres');
					return FALSE;
				}
				$temp .= $key."=:".$key." ".$whereOp.' ';
			}
			
			$temp = rtrim($temp, $whereOp.' ');
		}
		
		$params = array();
		
		foreach ($wheres as $key => $val)
		{
			$params[':'.$key] = $val;
		}

		return $this->prepared($temp, $params);
	}
	
	/*
	|----- Create 'insert' statement -----
	*/
	public function insert($table, $vals)
	{
		if ($table == NULL OR $table == '')
		{
			writeLog('Error', 'table value cannot be null or empty in PDO->insert');
			return FALSE;
		}
		
		if (!is_array($vals) OR count($vals) < 2)
		{
			writeLog('Error', 'invalid value submited in PDO->insert');
			return FALSE;
		}
		
		$temp = 'INSERT INTO '.$table.' (';
		
		foreach ($vals as $key => $val)
		{
			if ($key == '' OR preg_match('|^(\s)+$|', $key))
			{
				writeLog('Error', 'columns value cannot be null or empty in PDO->insert->columns');
				return FALSE;
			}
			
			$temp .= $key.', ';
		}
		
		$temp = rtrim($temp, ', ');
		
		$temp .= ') VALUES (';
		
		foreach ($vals as $key => $val)
		{
			$temp .= ":".$key.", ";
		}
		
		$temp = rtrim($temp, ', ').')';
		
		$params = array();
		
		foreach ($vals as $key => $val)
		{
			$params[':'.$key] = $val;
		}

		return $this->prepared($temp, $params);
	}
	
	/*
	|----- Create 'update' statement -----
	*/
	public function update($table, $vals, $wheres = NULL, $whereOp = 'AND')
	{
		if ($table == NULL OR $table == '')
		{
			writeLog('Error', 'table value cannot be null or empty in PDO->update');
			return FALSE;
		}
		
		if (!is_array($vals) OR count($vals) < 2)
		{
			writeLog('Error', 'invalid value submited in PDO->update');
			return FALSE;
		}
		
		$temp = 'UPDATE '.$table.' SET ';
		
		foreach ($vals as $key => $val)
		{
			if ($key == '' OR preg_match('|^(\s)+$|', $key))
			{
				writeLog('Error', 'columns value cannot be null or empty in PDO->update->columns');
				return FALSE;
			}
			
			$temp .= $key.'=:_'.$key.', ';
		}
		
		$temp = rtrim($temp, ', ');
		
		if (is_array($wheres) AND count($wheres) > 0)
		{
			$temp .= ' WHERE ';
			
			foreach ($wheres as $key => $val)
			{
				if ($key == '' OR preg_match('|^(\s)+$|', $key))
				{
					writeLog('Error', 'columns value cannot be null or empty in PDO->update->wheres');
					return FALSE;
				}
				$temp .= $key."=':".$key."' ".$whereOp.' ';
			}
			
			$temp = rtrim($temp, $whereOp.' ');
			
			$params = array();
		
			foreach ($wheres as $key => $val)
			{
				$params[':'.$key] = $val;
			}
			
			foreach ($vals as $key => $val)
			{
				$params[':_'.$key] = $val;
			}
			
			return $this->prepared($temp, $params);
			
		}
		
		return FALSE;
	}
	
	/*
	|----- Create 'delete' statement -----
	*/
	public function delete($table, $wheres = NULL, $whereOp = 'AND')
	{
		if ($table == NULL OR $table == '')
		{
			writeLog('Error', 'table value cannot be null or empty in PDO->delete');
			return FALSE;
		}
		
		$temp = 'DELETE FROM '.$table.' ';
		
		if (is_array($wheres) AND count($wheres) > 0)
		{
			$temp .= ' WHERE ';
			
			foreach ($wheres as $key => $val)
			{
				if ($key == '' OR preg_match('|^(\s)+$|', $key))
				{
					writeLog('Error', 'columns value cannot be null or empty in PDO->delete->wheres');
					return FALSE;
				}
				$temp .= $key."=':".$key."' ".$whereOp.' ';
			}
			
			$params = array();
		
			foreach ($wheres as $key => $val)
			{
				$params[':'.$key] = $val;
			}
			
			return $this->prepared($temp, $params);
		}
		
		return $this->exec($temp);
	}
	
	/*
	|----- Execute an SQL statement and return the number of affected rows -----
	*/
	public function exec($sql)
	{
		try
		{
			if (function_exists('mysql_real_escape_string'))
			{
				$sql = mysql_real_escape_string($sql);
			}
			
			$result = $this->con->exec($sql);
			
			if ($this->con->inTransaction())
			{
				$this->con->commit();
			}
			
			return $result;
		}
		catch(PDOException $ex)
		{
			if ($this->con->inTransaction())
			{
				$this->con->rollBack();
			}
			
			error('PDO Execution:', $ex->getMessage());
		}
	}
	
	/*
	|----- Executes an SQL statement, returning a result set as a PDOStatement object -----
	*/
	public function query($sql)
	{
		try
		{
			if (function_exists('mysql_real_escape_string'))
			{
				$sql = mysql_real_escape_string($sql);
			}
			
			$result = $this->con->query($sql);

			if ($this->con->inTransaction())
			{
				$this->con->commit();
			}
			
			return $result;
		}
		catch(PDOException $ex)
		{
			if ($this->con->inTransaction())
			{
				$this->con->rollBack();
			}
			
			error('PDO Query:', $ex->getMessage());
		}
	}
	
	public function prepared($statement, $params)
	{
		try
		{
			if (is_array($statement))
			{
				$result = array();
				
				foreach ($statement as $val)
				{
					$_statement = $this->con->prepare($statement);
					
					foreach ($params as $param)
					{
						$_statement->execute($params);

						$result[] = $_statement->fetch();
					
						if ($this->con->inTransaction())
						{
							$this->con->commit();
						}
						
						break;
					}
					
					$params = array_slice($params, 1);
				}
			}
			else
			{
				$_statement = $this->con->prepare($statement);
				
				$_statement->execute($params);
				
				$result[] = $_statement->fetch();
			
				if ($this->con->inTransaction())
				{
					$this->con->commit();
				}
				
				return $result;
			}
		}
		catch(PDOException $ex)
		{
			if ($this->con->inTransaction())
			{
				$this->con->rollBack();
			}
			
			error('PDO Prepared:', $ex->getMessage());
		}
	}
	
	public function setTransaction()
	{
		try
		{
			$this->con->beginTransaction();
		}
		catch(PDOException $ex)
		{			
			error('PDO begin transaction:', $ex->getMessage());
		}
	}
}

?>