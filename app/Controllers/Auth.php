<?php
class Controllers_Auth extends Libs_Controllers_Page
{
	protected $_require_auth = false;

	public function index()
	{
		if (is_auth())
		{
			redirect('/Default/');
		}

		if ($hashed_id = always_set($_COOKIE, 'remember_me', false))
		{
			$model = new Models_Auth();

			if ($data = $model->getUserByHashedId($hashed_id))
			{
				Models_CurrentUser::getInstance()->login($data);
				redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/');
			}
		}

		$view = Libs_Views::create('/auth/index.phtml')
			->assign('login_form_errors', always_set($_SESSION, 'login_form_errors', array()));

		unset($_SESSION['login_form_errors']);


		$this->render($view);
	}
}