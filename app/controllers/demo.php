<?php
class Controllers_Demo extends Controllers
{
	protected $_title = 'Demo';

	public function show()
	{
		$this->_view->render('view.phtml');
	}
}
