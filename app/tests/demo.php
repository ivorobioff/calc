<?php
class Tests_Demo extends PHPUnit_Framework_TestCase
{
	public function testAlert()
	{
		$this->assertFalse(1 == 0, 'ok');
	}
}