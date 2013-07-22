<?php
class Libs_Validator_Plugins_Setness extends Libs_Validator_Plugins_Abstract
{
	private $_required_fields;

	private $_fields;

	public function setRequiredFields(array $fields)
	{
		$this->_required_fields = $fields;
		return $this;
	}

	public function setFields(array $fields)
	{
		$this->_fields = $fields;
		return $this;
	}

	public function check()
	{
		if (!$this->_required_fields) return true;

		foreach ($this->_required_fields as $item)
		{
			if (!isset($this->_fields[$item])) return false;
		}

		return true;
	}

	public function getMissingFields()
	{
		$fields = array();

		if (!$this->_required_fields) return array();

		foreach ($this->_required_fields as $item)
		{
			if (!isset($this->_fields[$item])) $fields[] = $item;
		}

		return $fields;
	}
}