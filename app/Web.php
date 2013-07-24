<?php
class App_Web
{
	public function start()
	{
		session_start();
		$this->_registerAutoloader();
		require_once APP_DIR.'/libs/shortcuts.php';

		$router = new Libs_Router();
		try
		{
			$router->parse();
		}
		catch (Libs_Exceptions_Error404 $ex)
		{
			$error404 = new Controllers_Error404();
			return $error404->show();
		}

		$router->getControllerObject()->{$router->getActionName()}($router->getParams());
	}

	private function _registerAutoloader()
	{
		require_once APP_DIR.'/libs/autoloader.php';
		spl_autoload_register('Libs_Autoloader::run');
	}
}