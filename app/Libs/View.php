<?php
class Libs_View extends Libs_Singleton
{
	static private $_INSTANCE;

	private $_params = array();

	private $_layout = '';
	private $_view = '';

	/**
	 * @return Libs_View
	 */
	static public function getInstance()
	{
		return parent::getInstance();
	}

	public function assign($key, $value, $html_special_chars = true)
	{
		if ($html_special_chars)
		{
			$value = htmlspecialchars($value);
		}

		$this->_params[$key] = $value;
	}

	public function render($path = '')
	{
		$path = trim(trim($path, '/'));

		if ($path)
		{
			$this->_view =  APP_DIR.'/views/'.$path;
		}

		include_once  $this->_layout;

		$this->_clear();
	}

	public function setLayout($path)
	{
		$this->_layout = APP_DIR.'/views/'.$path;
	}

	protected function _renderView()
	{
		if (!$this->_view)
		{
			return ;
		}

		include_once $this->_view;
	}

	public function block($path, $params = array(), $show_now = true)
	{
		ob_start();
		include APP_DIR.'/views/'.$path;
		$html = ob_get_clean();

		if (!$show_now)
		{
			return $html;
		}

		echo $html;
	}

	private function _clear()
	{
		$this->_params = array();
		$this->_view = '';
	}
}