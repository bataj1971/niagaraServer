<?php
namespace Util;
/**
 * Description of JsonHandler
 *
 * @author Bata Jozsef
 * 
 */
trait JsonHandler
{
	/**
	 *
	 * @param string $fileName
	 * @param type   $throwException
	 *
	 * @return type
	 * @throws Exception
	 */
	protected function getJsonFromFile(string $fileName, bool $throwException = true) : array
	{
		$success    = true;
		$jsonstring = file_get_contents($fileName);

		if (!$jsonstring and !$throwException)
		{
			return [];
		}

		$json = json_decode($jsonstring, true);

		if (json_last_error() !== JSON_ERROR_NONE)
		{
			$success   = false;
			$jsonerror = json_last_error_msg();
		}

		if ($throwException and !$success)
		{
			throw new \Exception("getJsonToFile error: [$fileName] error:$jsonerror");
		}

		return $json;
	}

	/**
	 *
	 * @param array  $array
	 * @param string $fileName
	 * @param type   $throwException
	 *
	 * @return type
	 * @throws Exception
	 */
	protected function putJsonToFile(array $array, string $fileName, $throwException = true):bool
	{
		$success    = false;
		$jsonString = json_encode($array, JSON_PRETTY_PRINT);

		$success = file_put_contents($fileName, $jsonString);

		if ($throwException and ($success === false))
		{
			throw new \Exception("putJsonToFile error: [$fileName]");
		}

		return $success;
	}
}
