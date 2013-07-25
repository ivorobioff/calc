<?php
class Controllers_Auth extends Controllers_Abstracts_Page
{
	public function index()
	{
		$this->render(Libs_Views::create('/auth/index.phtml'));
	}

	public function signup()
	{

	}
}