<?php
class Config
{
	static function getCustom($var)
	{
		require_once APP_DIR.'/config/custom.php';
		return ${$var};
	}
}