<?php
class Controllers_Auth extends Libs_Controllers_Page
{
	public function index()
	{
		$this->render(Libs_Views::create('/auth/index.phtml'));
	}
}