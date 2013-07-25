<?php
class Controllers_AuthProcessor extends Libs_Controllers_Processor
{
	protected $_require_auth = false;

	public function signin()
	{
		if (!Libs_Validators::getEmailValidator()
				->setEmail($_POST['email'])
				->verify())
		{
			$_SESSION['login_form_errors']['email'] = _t('/auth/validator/wrong_email_format');
			redirect('/Auth/');
		}

		if (!Libs_Validators::getPasswordValidator()
				->setPass($_POST['pass'])
				->checkLength())
		{
			$_SESSION['login_form_errors']['pass'] = _t('/auth/validator/wrong_pass_length');
			redirect('/Auth/');
		}

		$model = new Models_Auth();

		if (!$data = $model->getUserByCredentials($_POST['email'], $_POST['pass']))
		{
			$_SESSION['login_form_errors']['email'] = _t('/auth/validator/no_user');
			redirect('/Auth/');
		}

		Models_CurrentUser::getInstance()->login($data, isset($_POST['remember_me']));

		redirect('/Default/');
	}

	public function signout()
	{
		Models_CurrentUser::getInstance()->logout();
		redirect('/Auth/');
	}

	public function signup()
	{
		if (!$this->isAjax())
		{
			redirect('/Auth/');
		}

		$missing_fields = Libs_Validators::getSetnessValidator()
			->setRequiredFields(array('fio', 'email', 'pass', 'conf_pass'))
			->setFields($_POST)
			->getMissingFields();

		if ($missing_fields)
		{
			foreach ($missing_fields as $item)
			{
				$errors[$item] = 'Не задано поле';
			}

			return $this->ajaxError($errors);
		}

		if (!Libs_Validators::getEmailValidator()
				->setEmail($_POST['email'])
				->verify())
		{
			return $this->ajaxError(array('email' => _t('/auth/validator/wrong_email_format')));
		}

		$pass_validator = Libs_Validators::getPasswordValidator()
			->setPass($_POST['pass'])
			->setConfirmPass($_POST['conf_pass']);

		if (!$pass_validator->checkLength())
		{
			return $this->ajaxError(array('pass' => _t('/auth/validator/wrong_pass_length')));
		}

		if (!$pass_validator->checkIfEqual())
		{
			return $this->ajaxError(array('pass' => _t('/auth/validator/diff_passes')));
		}

		$model = new Models_Auth();

		if ($model->checkEmail($_POST['email']))
		{
			return $this->ajaxError(array('email' => _t('/auth/validator/user_exists')));
		}

		if (!$user_id = $model->addUser($_POST))
		{
			return $this->ajaxError(array('message' => _t('/auth/validator/cannot_register')));
		}

		Models_CurrentUser::getInstance()->login($model->getUserById($user_id));

		return $this->ajaxSuccess();
	}
}