<?php
class Libs_Validator_Plugins_Email extends Libs_Validator_Plugins_Abstract
{
	private $_email;

	public function setEmail($email)
	{
		$this->_email = $email;
		return $this;
	}

	public function verify()
	{
		return preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $this->_email);
	}
}