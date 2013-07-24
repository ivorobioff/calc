<?php
class Controllers_Default extends Controllers
{
	protected $_title = 'Demo';

	public function index()
	{
		$this->_view->render('view.phtml');
	}
}
