<?php
class Controllers_Default extends Controllers_Page
{
	protected $_title = 'Hello World';

	public function index()
	{
		$view = Libs_Views::create('view.phtml')
			->assign('first_name', 'Igor')
			->assign('last_name', 'Vorobioff');

		$this->renderPage($view);
	}
}
