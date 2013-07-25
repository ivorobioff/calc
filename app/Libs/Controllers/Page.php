<?php
abstract class Libs_Controllers_Page
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

	protected function render(Libs_Views $view)
	{
		$this->_layout
			->assign('view', $view)
			->assign('title', $this->_title)
			->render();
	}
}
