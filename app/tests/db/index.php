<?php
abstract class Tests_Db extends Libs_ActiveRecord
{
	protected $_db_name = 'test_default';

	protected function _getConfig()
	{
		return Config::getCustom('test_db');
	}
}