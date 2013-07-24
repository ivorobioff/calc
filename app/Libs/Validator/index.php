<?php
class Libs_Validator
{
	/**
	 * @return Libs_Validator_Plugins_Email
	 */
	static public function getEmailValidator()
	{
		return new Libs_Validator_Plugins_Email();
	}

	/**
	 * @return Libs_Validator_Plugins_Password
	 */
	static public function getPasswordValidator()
	{
		return new Libs_Validator_Plugins_Password();
	}

	/**
	 * @return Libs_Validator_Plugins_Setness
	 */
	static public function getSetnessValidator()
	{
		return new Libs_Validator_Plugins_Setness();
	}
}