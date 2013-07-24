<?php
class Libs_Router
{
	private $_controller_object;
	private $_action_name;
	private $_params;

	public function parse()
	{
		$url_path = $_SERVER['REQUEST_URI'];

		$url_parts = explode('?', $url_path);

		$url_path = always_set($url_parts, 0, '');
		$url_path = trim(trim($url_path), '/');

		$url_query = always_set($url_parts, 1, '');

		$url_query_array = array();
		parse_str($url_query, $url_query_array);

		$url_array = array();

		if ($url_path)
		{
			$url_array = explode('/', $url_path);
		}

		if (strtolower(always_set($url_array, 0, '')) == 'test')
		{
			$test_controller_class = 'Controllers_Test';
			$this->_controller_object = new $test_controller_class('Tests_'.always_set($url_array, 1));
			$this->_action_name = 'run';
			$this->_params = array();
			return ;
		}

		if (!isset($url_array[0]))
		{
			$path_config = Libs_Config::getCustom('path_config');
			$controller_name = $path_config['controller'];
			$this->_action_name = always_set($url_array, 1, always_set($path_config, 'action', 'index'));
		}
		else
		{
			$controller_name = $url_array[0];
			$this->_action_name = always_set($url_array, 1, 'index');
		}

		array_shift($url_array);
		array_shift($url_array);

		$this->_params = $url_array;

		$_GET = array_merge($_GET, $url_query_array);
		$_GET['controller'] = $controller_name;
		$_GET['action'] = $this->_action_name;

		if (!file_exists(APP_DIR.'/Controllers/'.$controller_name.'.php'))
		{
			throw new Libs_Exceptions_Error404();
		}

		$controller_class = 'Controllers_'.$controller_name;

		if (!class_exists($controller_class))
		{
			throw new Libs_Exceptions_Error404();
		}

		$this->_controller_object = new $controller_class();

		if (!method_exists($this->_controller_object, $this->_action_name))
		{
			throw new Libs_Exceptions_Error404();
		}
	}

	public function getControllerObject()
	{
		return $this->_controller_object;
	}

	public function getActionName()
	{
		return $this->_action_name;
	}

	public function getParams()
	{
		return $this->_params;
	}
}