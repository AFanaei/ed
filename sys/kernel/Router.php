<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		EasyDev
 * @subpackage	Kernel/Router
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class ED_Router
{

	/*
	|----- Return current operation result -----
	*/
	var $isConfirmed = FALSE;
	/*
	|----- Current class name -----
	*/
	var $class = '';
	
	/*
	|----- Current method name -----
	*/
	var $method = '';
	
	/*
	|----- Sub directory that contains the requested controller class -----
	*/
	var $directory = '';
	
	/*
	|----- Current requests -----
	*/
	var $requests = array();
	
	/*
	|----- Load needed classes  -----
	*/
	function __construct()
	{
		$this->uri =& loadClass('Uri', 'ED_Uri', 'uri', 'kernel');
		writeLog('Debug', 'Router class initialized.');
	}
	
	/*
	|----- Parse current uri string to directory, class, method, requests and then call requested method -----
	*/
	public function setRouting()
	{
		$this->_setRouting();
		$this->callRequestedMethod();
	}
	
	private function _setRouting()
	{
		if (getConfigItem('switchToQueryString') == FALSE)
		{
			$this->reRouting();
			$this->uri->splitUri();
			$this->validate($this->uri->splittedUriString);
		}
		else
		{
			$this->validate();
		}
	}
	
	/*
	|----- Return currnet requested class -----
	*/
	public function getClass()
	{
		return $this->class;
	}
	
	/*
	|----- Set currnet requested class -----
	*/
	private function setClass($var)
	{
		$this->class = $var;
	}
	
	/*
	|----- Return current requested method -----
	*/
	public function getMethod()
	{
		return $this->method;
	}
	
	/*
	|----- Set currnet requested method -----
	*/
	private function setMethod($var)
	{
		$this->method = $var;
	}
	
	/*
	|----- Return current requested sub directory -----
	*/
	public function getDirectory()
	{
		return $this->directory;
	}
	
	/*
	|----- Set current requested sub directory -----
	*/
	private function setDirectory($var)
	{
		$this->directory = $var;
	}
	
	/*
	|----- Return current requests  -----
	*/
	public function getRequests()
	{
		return $this->requests;
	}
	
	/*
	|----- Set current requests -----
	*/
	private function setRequests($vars)
	{
		$this->requests = $vars;
	}
	
	/*
	|----- Remapping current uri if needed -----
	*/
	private function reRouting()
	{
		if (file_exists(APPPATH.'config/RoutingRules.php'))
		{
			include(APPPATH.'config/RoutingRules.php');

			if (isset($routingRules) AND is_array($routingRules))
			{
				foreach($routingRules as $key => $val)
				{
					if (preg_match('|'.$key.'$|', $this->uri->uriString))
					{
						$this->uri->uriString = preg_replace('|'.$key.'$|', $val, $this->uri->uriString);
						break;
					}
				}
			}
			
			unset($routingRules);
		}
	}
	
	/*
	|----- Validate current requested uri -----
	*/
	private function validate($array = array())
	{
		if (getConfigItem('switchToQueryString') == FALSE)
		{
			try
			{
				if (is_array($array) AND count($array) > 1)
				{
					if (file_exists(APPPATH.'controllers/'.$array[0].'.php'))
					{
						include(APPPATH.'controllers/'.$array[0].'.php');
						
						if (class_exists($array[0]) AND in_array(strtolower($array[1]), array_map('strtolower', get_class_methods($array[0]))))
						{
							$this->setClass($array[0]);
							$this->setMethod($array[1]);
							$this->setRequests(array_slice($array, 2));
							$this->isConfirmed = TRUE;
							return;
						}
						else
						{
							error_404($this->uri->uriString);
						}
					}
					elseif (file_exists(APPPATH.'controllers/'.$array[0].'/'.$array[1].'.php'))
					{
						include(APPPATH.'controllers/'.$array[0].'/'.$array[1].'.php');
						
						if (class_exists($array[1]) AND in_array(strtolower($array[2]), array_map('strtolower', get_class_methods($array[1]))))
						{
							$this->setClass($array[1]);
							$this->setMethod($array[2]);
							$this->setRequests(array_slice($array, 3));
							$this->isConfirmed = TRUE;
							return;
						}
						else
						{
							error_404($this->uri->uriString);
						}
					}
					else
					{
						error_404($this->uri->uriString);
					}
				}
				else
				{
					$this->setDefaults();
				}
			}
			catch(Exception $x)
			{
				writeLog('Error', 'Router: '. $x.getMessage());
				$this->setDefaults();
			}
		}
		else
		{
			$this->setClass((isset($_GET[getConfigItem('controllerKey')])) ?  trim($this->uri->validateUri($_GET[getConfigItem('controllerKey')]), '/') : getConfigItem('defaultController'));
			$this->setMethod((isset($_GET[getConfigItem('functionKey')])) ?  trim($this->uri->validateUri($_GET[getConfigItem('functionKey')]), '/') : getConfigItem('defaultMethod'));
			$this->setDirectory((isset($_GET[getConfigItem('directoryKey')])) ? trim($this->uri->validateUri($_GET[getConfigItem('directoryKey')]), '/').'/' : '');
			
			if (file_exists(APPPATH.'controllers/'.$this->getDirectory().$this->getClass().'.php'))
			{
				include(APPPATH.'controllers/'.$this->getDirectory().$this->getClass().'.php');
				
				if (class_exists($this->getClass()) AND in_array(strtolower($this->getMethod()), array_map('strtolower', get_class_methods($this->getClass()))))
					{
						$this->isConfirmed = TRUE;
						return;
					}
					else
					{
						error_404($this->uri->uriString);
					}
			}
			else
			{
				error_404($this->uri->uriString);
			}
		}
	}
	
	/*
	|----- Set default controller -----
	*/
	private function setDefaults()
	{
		$this->setClass(getConfigItem('defaultController'));
		$this->setMethod(getConfigItem('defaultMethod'));

		if (file_exists(APPPATH.'controllers/'.$this->getClass().'.php'))
		{
			$this->isConfirmed = TRUE;

			include(APPPATH.'controllers/'.$this->getClass().'.php');
		}
		else
		{
			error_404($this->uri->uriString);
		}
	}
	
	/*
	|----- Call current requested method -----
	*/
	private function callRequestedMethod()
	{
		if ($this->isConfirmed)
		{
			$_temp = $this->getClass();
			$_tempClass = new $_temp();
			call_user_func(array($_tempClass, $this->getMethod()), $this->getRequests());
			unset($_tempClass);
		}
	}

}