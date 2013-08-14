<?php if (!defined('SYSPATH')) { require('../AccessDenied/AccessDenied.php'); exit; }

/**
 * EasyDev
 * 
 * An open source application development framework for PHP 5.1.6 or newer
 *	--
 * @package		EasyDev
 * @subpackage	Kernel/Loader
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class ED_Loader
{
	
	function __construct()
	{
		$this->loadDefaults();
		
		writeLog('Debug', 'Loader class initialized.');
	}
	
	/*
	|----- Load requested controller/method with data -----
	*/
	public function controller($controller, $method = '', $data = array())
	{
		return $this->_controller($controller, $method, $data);
	}
	
	private function _controller($controller, $method = '', $data = array())
	{
		if (is_array($controller))
		{
			$class = $controller[0];
			$path = trim($controller[1], '/');
			$folder = (isset($controller[2]) AND trim($controller[2], '/') != '') ? trim($controller[2], '/') : 'controllers';

			if (file_exists(APPPATH.$folder.'/'.$path.'.php'))
			{
				$method = ($method == '') ? getConfigItem('defaultMethod') : $method;
				
				require_once(APPPATH.$folder.'/'.$path.'.php');
				
				if (class_exists($class) AND in_array(strtolower($method), array_map('strtolower', get_class_methods($class))))
				{
					$tempED = new $class();
					return call_user_func(array($tempED, $method), $data);					
				}
				
				error('Error', 'Controller: Unknowen call, requested {'.$class.'}/{'.$method.'} is not found.');
			}
			
			error('Error', 'Controller: {'.$folder.'}/{'.$path.'} does not found.');
		}
		
		error('Error', 'Controller: Invalid request for calling controller.');
	}
	
	/*
	|----- Load requested model/method with data -----
	*/
	public function model($model, $method = '', $data = array())
	{
		return $this->_model($model, $method, $data);
	}
	
	private function _model($model, $method = '', $data = array())
	{
		if (is_array($model))
		{
			$class = $model[0];
			$path = trim($model[1], '/');
			$folder = (isset($model[2]) AND trim($model[2], '/') != '') ? trim($model[2], '/') : 'models';

			if (file_exists(APPPATH.$folder.'/'.$path.'.php'))
			{
				$method = ($method == '') ? getConfigItem('defaultMethod') : $method;
				
				require_once(APPPATH.$folder.'/'.$path.'.php');
				
				if (class_exists($class) AND in_array(strtolower($method), array_map('strtolower', get_class_methods($class))))
				{
					$tempED = new $class();
					return call_user_func(array($tempED, $method), $data);						
				}
				
				writeLog('Error', 'Model: Unknowen call, requested {$class}/{$method} does not found.');
				return FALSE;
			}
			
			writeLog('Error', 'Model: {$folder}/{$path} does not found.');
			return FALSE;
		}
		
		log('Error', 'Model: Invalid request for calling model.');
		return FALSE;
	}
	
	/*
	|----- Load requested view/method with data -----
	*/
	public function view($view, $method = '', $data = array())
	{
		return $this->_view($view, $method, $data);
	}
	
	private function _view($view, $method = '', $data = array())
	{
		if (is_array($view))
		{
			$class = $view[0];
			$path = trim($view[1], '/');
			$folder = (isset($view[2]) AND trim($view[2], '/') != '') ? trim($view[2], '/') : 'views';
			
			if (file_exists(APPPATH.$folder.'/'.$path.'.php'))
			{
				$method = ($method == '') ? getConfigItem('defaultMethod') : $method;

				require_once(APPPATH.$folder.'/'.$path.'.php');
				
				if (class_exists($class) AND in_array(strtolower($method), array_map('strtolower', get_class_methods($class))))
				{
					$tempED = new $class();
					call_user_func(array($tempED, $method), $data);
					unset($tempED);
					return TRUE;
				}
				
				writeLog('Error', 'View: Unknowen call, requested {$class}/{$method} does not found.');
				return FALSE;
			}
			
			writeLog('Error', 'View: {$path} is not found.');
			return FALSE;
		}
		
		writeLog('Error', 'View: Invalid request for calling view.');
		return FALSE;
	}
	
	/*
	|----- Auto-load user defined libraries -----
	*/
	private function loadDefaults()
	{
		if (file_exists(APPPATH.'config/autoloader.php'))
		{
			require(APPPATH.'config/autoloader.php');
			
			if (isset($auto['libraries']) AND is_array($auto['libraries']) AND count($auto['libraries']) > 0)
			{
				foreach ($auto['libraries'] as $_auto)
				{
					if (isset($_auto[3]))
					{
						loadClass($_auto[0], $_auto[1], $_auto[2], $_auto[3]);
					}
					else
					{
						loadClass($_auto[0], $_auto[1], $_auto[2]);
					}
				}
			}
		}
	}
}

?>