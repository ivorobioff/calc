<?php
abstract class Controllers_Page extends Controllers
{
	/**
	 * @var Libs_Views
	 */
	protected $_layout;
	protected $_title = 'Calc 1.0';

	public function __construct()
	{
		$this->_layout = Libs_Views::create('layout.phtml');
	}

	protected function renderPage(Libs_Views $view)
	{
		$this->_layout
			->assign('view', $view)
			->assign('title', $this->_title)
			->render();
	}
}
