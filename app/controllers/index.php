<?php
abstract class Controllers
{
	/**
	 * @var Libs_View
	 */
	protected $_view;

	protected $_title = 'Bloculmeu 1.0';

	public function __construct()
	{
		$this->_view = Libs_View::getInstance();
		$this->_view->assign('title', $this->_title);
		$this->_view->setLayout('layout.phtml');
	}
}
