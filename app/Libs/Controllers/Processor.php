<?php
abstract class Libs_Controllers_Processor extends Libs_Controllers
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->_checkAuth())
		{
			return ;
		}
	}

	protected function isAjax()
	{
		return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
			&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
	}

	protected function ajaxSuccess(array $data = array())
	{
		echo json_encode(array('status' => 'success', 'data' => $data));
	}

	protected function ajaxError(array $data = array())
	{
		echo json_encode(array('status' => 'error', 'data' => $data));
	}
}
