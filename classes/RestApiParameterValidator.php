<?php
require_once('classes/JsonHandler.php');

/**
 *
 */
abstract class RestApiParameterValidator
{
	use JsonHandler;

	/**
	 * @var array
	 */
	protected $fieldList = [];

	/**
	 * @var string
	 */
	protected $dataPath = '';

	/**
	 * @param string $validatorName
	 *
	 * @throws Exception
	 */
	public function __construct(array $fieldList = [])
	{
		$this->fieldList = $fieldList;
	}

	/**
	 * @return string
	 */
	// abstract protected function getDataPath(): string;

	/**
	 * @param array  $parameterList
	 * @param bool   $throwException
	 * @param string $message
	 *
	 * @return array
	 * @throws RestApiException
	 */
	public function validate(array $parameterList, bool $throwException = false, $message = "Validation error")
	{
		$errorList = [];
		foreach ($this->fieldList as $fieldName => $fieldProps)
		{
			$requiredInParamList = $fieldProps['required'] ?? true;
			$canNotBeEmpty       = $fieldProps['cannotbeempty'] ?? true;
			$type                = $fieldProps['type'] ?? 'string';

			if ($requiredInParamList and !isset($parameterList[$fieldName]))
			{
				$errorList[] = "Field [$fieldName] is required in the parameterlist";
			}
			elseif ($canNotBeEmpty and $this->isEmpty($parameterList[$fieldName], $type))
			{
				$errorList[] = "Field [$fieldName] can not be empty";
			}
		}
		if ($throwException and count($errorList)>0)
		{
			throw new RestApiException($message, 0, $errorList, 400);
		}

		return $errorList;
	}

	/**
	 * @param        $value
	 * @param string $type
	 *
	 * @return bool
	 */
	protected function isEmpty($value, string $type = 'string')
	{
		$isEmpty = false;

		switch ($type) {

			case 'email':
			case 'string':
				$isEmpty = trim($value) === '';
				break;
			case 'number':
				$isEmpty = $value <> 0;
				break;
			case 'date':
				$isEmpty = trim($value) === '';
				break;

			default:
				$isEmpty = empty($value);
		}

		return $isEmpty;
	}
}