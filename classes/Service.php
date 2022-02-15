<?php


require_once('classes/JsonHandler.php');

/**
 * Description of Service
 *
 * @author Bata Jozsef
 */
abstract class Service
{
	use JsonHandler;

	/**
	 *
	 * @var array
	 */
	protected $response = [];

	/**
	 * @var DBManager|object|null
	 */
	protected $db;

	/**
	 * @var array
	 */
	protected $headers = [];

	/**
	 * @var array
	 */
	protected $messages         = [];

	protected $supressException = false;

	/**
	 * Service constructor.
	 *
	 * @param array $response
	 */
	function __construct(array $response = [])
	{



		$this->response = $response;
		$this->messages = [
			'norecordsfoundwithid'       => 'No record found with specified id',
			'multiplerecordsfoundwithid' => 'Multiple records found with specified id',
			'indexmethodnotimplemented'  => 'index method not implemented',
			'putmethodnotimplemented'    => 'PUT method not implemented',
			'getmethodnotimplemented'    => 'GET method not implemented',
			'postmethodnotimplemented'   => 'POST method not implemented',
			'deletemethodnotimplemented' => 'DELETE method not implemented',
			'norecordsfound'             => 'No records found',

		];
		$this->initService();
	}

	/**
	 * @return mixed
	 */
	abstract protected function initService();

	/**
	 *
	 * @return array
	 */
	final public function getHeaders(): array
	{
		return $this->headers;
	}

	/**
	 * @param array $parameters
	 *
	 * @return array
	 * @throws RestApiException
	 */
	public function get(array $parameters): array
	{
		throw new RestApiException(
		// 'get method not implemented'
			$this->getMessage("getmethodnotimplemented")

		);
	}

	/**
	 * @param array $parameters
	 *
	 * @return array
	 * @throws RestApiException
	 */
	public function put(array $parameters): array
	{
		throw new RestApiException(
		//'put method not implemented'
			$this->getMessage("putmethodnotimplemented")
		);
	}

	/**
	 * @param array $parameters
	 *
	 * @return array
	 * @throws RestApiException
	 */
	public function post(array $parameters): array
	{
		throw new RestApiException(
		//'post method not implemented'
			$this->getMessage("postmethodnotimplemented")

		);
	}

	/**
	 * @param array $parameters
	 *
	 * @return array
	 * @throws RestApiException
	 */
	public function delete(array $parameters): array
	{
		throw new RestApiException(
		// 'delete method not implemented'
			$this->getMessage("deletemethodnotimplemented")
		);
	}

	/**
	 * @param array $parameters
	 *
	 * @return array
	 * @throws RestApiException
	 */
	public function index(array $parameters): array
	{
		throw new RestApiException(
		// 'index method not implemented'
			$this->getMessage("indexmethodnotimplemented")

		);
	}

	/**
	 *
	 * @param string $type
	 * @param string $value
	 */
	final protected function addHeader(string $type, string $value)
	{
		$this->headers[$type] = $value;
	}

	/**
	 * @param string $sql
	 * @param string $idField
	 *
	 * @return array
	 */
	protected function getSqlQuery(string $sql, string $idField = ''): array
	{
		// $db       = DBManagerFactory::getInstance();
		$result   = [];
		$resource = $db->query($sql, true);

		while ($row = $db->fetchByAssoc($resource))
		{
			if ($idField and isset($row[$idField]))
			{
				$result[$row[$idField]] = $row;
			}
			else
			{
				array_push($result, $row);
			}
		}

		return $result;
	}

	/**
	 * Checking if a resultset contains at least on and only one record
	 *
	 * @param $result
	 *
	 * @throws RestApiException
	 */
	protected function checkSingleResult($result)
	{
		if (count($result) == 0)
		{
			throw new RestApiException(
			// "No record found with specified id",
				$this->getMessage("norecordsfoundwithid"),
				0, [], 404,
				$this->getDescription("norecordsfoundwithid")
			);
		}

		if (count($result) > 1)
		{
			if ($this->supressException)
			{
				// return only the first record..
				$result = [$result[0]];
			}
			else
			{
				throw new RestApiException(
				// "Multiple records found with specified id",
					$this->getMessage("multiplerecordsfoundwithid"),
					0, [], 404,
					$this->getDescription("multiplerecordsfoundwithid")
				);
			}
		}
	}

	/**
	 * Checking if a resultset contains at least on record
	 *
	 * @param $result
	 *
	 * @throws RestApiException
	 */
	protected function checkEmptyResult($result)
	{
		if (empty($result))
		{
			throw new RestApiException(
				$this->getMessage("norecordsfound"),
				0, [], 404,
				$this->getDescription("norecordsfound")
			);
		}
		if (count($result) == 0)
		{
			throw new RestApiException(
				$this->getMessage("norecordsfound"),
				0, [], 404,
				$this->getDescription("norecordsfound")
			);
		}
	}

	/**
	 * @param array $target - handled by reference
	 * @param array $remove - remove fields listed in remove array
	 * @param array $allow  - remove fields not allowed - do nothing if allow empty
	 */
	protected function cleanArray(array &$target, array $remove = [], array $allow = [])
	{
		foreach ($target as &$item)
		{
			// remove fields listed in remove array
			if ($remove)
			{
				foreach ($remove as $fieldName)
				{
					unset($item[$fieldName]);
				}
			}

			// remove fields not allowed - do nothing if allow empty
			if ($allow)
			{
				foreach ($item as $fieldName)
				{
					if (!in_array($fieldName, $allow))
					{
						unset($item[$fieldName]);
					}
				}
			}
		}
	}

	/**
	 * @param $value
	 *
	 * @return false
	 */
	protected function valueSet(array $container, string $key)
	{
		if (!isset($container[$key]))
		{
			return false;
		}
		if ($container[$key] === null)
		{
			return false;
		}
		if ($container[$key] === '')
		{
			return false;
		}

		return true;
	}

	/**
	 * @param string $messageId
	 *
	 * @return mixed|string
	 */
	protected function getMessage(string $messageId = '')
	{
		$messageText = $this->messages[$messageId] ?? 'Unknown error';

		return $messageText;
	}

	/**
	 * @param string $messageId
	 *
	 * @return string
	 */
	protected function getDescription(string $messageId = '')
	{
		return 'No description';
	}

	protected function authorizeService()
	{
	}


}