<?php
class Controllers_AuthProcessor extends Libs_Controllers_Processor
{
	public function signin()
	{
		redirect(_url('Auth'));
	}

	public function signout()
	{

	}

	public function signup()
	{
		if (!$this->isAjax())
		{
			redirect(_url('Auth'));
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
			return $this->ajaxError(array('email' => 'Не верный формат e-mail'));
		}

		$pass_validator = Libs_Validators::getPasswordValidator()
			->setPass($_POST['pass'])
			->setConfirmPass($_POST['conf_pass']);

		if (!$pass_validator->checkLength())
		{
			return $this->ajaxError(array('pass' => 'Не верная длина пароля'));
		}

		if (!$pass_validator->checkIfEqual())
		{
			return $this->ajaxError(array('pass' => 'Пароли разные'));
		}

		/*

		$model = new Models_Users();

		if ($model->checkEmail($_POST['email']))
		{
			return send_form_error(array('email' => _t('/signup/email-busy')));
		}

		if (!$user_id = $model->add($_POST))
		{
			return send_form_error(array('message' => 'unkown error'));
		}


		if ($geo_buidling === 0)
		{
			$building_model = new Models_Buildings();

			if (!$building_info = $building_model->getByAddress($_POST['street'], $_POST['number']))
			{
				return send_form_error(array('street' => _t('/signup/building-not-found')));
			}

			$building_id = $building_info['id'];
		}
		else
		{
			$building_id = $geo_buidling;
		}

		if (!$model->assignBuilding($user_id, $building_id, true))
		{
			return send_form_error(array('message' => 'unkown error'));
		}

		return send_form_success();
		*/
		return $this->ajaxSuccess();
	}
}