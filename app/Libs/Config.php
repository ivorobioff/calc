<?php
class Libs_Config
{
	static function getCustom($var, $default = null)
	{
		require_once APP_DIR.'/config/custom.php';

		if (isset(${$var}))
		{
			return ${$var};
		}

		return $default;
	}
}