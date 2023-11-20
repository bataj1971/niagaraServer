<?php
// require_once ('classes/RestApiParameterValidator.php');

/**
 *
 */
class TestApiParameterValidator extends RestApiParameterValidator
{
	/**
	 * @return string
	 */
	protected function getDataPath(): string
	{
		return "data/";
	}
}