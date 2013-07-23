<?php
abstract class Db extends Libs_ActiveRecord
{
	protected function _getConfig()
	{
		return Config::getCustom('db_config');
	}
}