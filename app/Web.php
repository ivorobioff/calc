<?php
class App_Web
{
	public function start()
	{
		session_start();
		$this->_registerAutoloader();
		require_once APP_DIR.'/Libs/shortcuts.php';

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
		require_once APP_DIR.'/Libs/Autoloader.php';
		spl_autoload_register(array(new Libs_Autoloader(), 'parse'));
	}
}