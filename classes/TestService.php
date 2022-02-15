<?php


require_once('classes/TestApiParameterValidator.php');

/**
 *
 */
class TestService extends Service
{
	/**
	 * @var
	 */
	protected $entityName;

	/**
	 * @var array
	 */
	protected $params = [];

	/**
	 * @var bool
	 */
	protected $debug = false;

	/**
	 * @var array
	 */
	protected $fieldList = [];

	/**
	 * @param array $parameters
	 */
	public function setParams(array $parameters = [])
	{
		$this->params = $parameters;
	}

	/**
	 * @return mixed|void
	 */
	protected function initService()
	{

		/**
		 * Default values:
		 * 'norecordsfoundwithid'       => 'No record found with specified id',
		 * 'multiplerecordsfoundwithid' => 'Multiple records found with specified id',
		 * 'indexmethodnotimplemented'  => 'index method not implemented',
		 * 'putmethodnotimplemented'    => 'PUT method not implemented',
		 * 'getmethodnotimplemented'    => 'GET method not implemented',
		 * 'postmethodnotimplemented'   => 'POST method not implemented',
		 * 'deletemethodnotimplemented' => 'DELETE method not implemented',
		 * 'norecordsfound'             => 'No records found',
		 */
		$this->messages['norecordsfoundwithid'] = 'no records found';
		$this->messages['norecordsfound']       = 'no records found';

		$this->entityName = $this->getEntityName();

		$this->supressException = $sugar_config['']['apisettings']['SLR']['supress_multiple_id_error'] ?? false;
		$this->debug            = $sugar_config['']['apisettings']['SLR']['debug'] ?? false;

		$this->loadFieldStructure();
	}

	/**
	 * @return false|string
	 */
	protected function getEntityName()
	{
		$className  = get_class($this);
		$entityName = substr($className, 11);
		$entityName = substr($entityName, 0, -7);

		return $entityName;
	}

	/**
	 * @param string $messageId
	 *
	 * @return string
	 */
	protected function getDescription(string $messageId = '')
	{
		$description = '';
		switch ($messageId)
		{
			case 'norecordsfoundwithid':
				$description = "{$this->entityName} with the id not found";
				break;
		}

		return $description;
	}

	/**
	 * @throws Exception
	 */
	protected function loadFieldStructure()
	{
		$metaFileName = substr(get_class($this), 11, -7);
		$jsopnPath    = "data/{$metaFileName}.json";
		$structure    = $this->getJsonFromFile($jsopnPath, false);
		$fields       = $structure['fields'] ?? [];
		foreach ($fields as $fieldName => $fieldProps)
		{
			$fieldProps['type']          = $fieldProps['type'] ?? 'string';
			$fieldProps['required']      = $fieldProps['required'] ?? true;
			$fieldProps['cannotbeempty'] = $fieldProps['cannotbeempty'] ?? true;
			$fieldProps['restrictedfor'] = $fieldProps['restrictedfor'] ?? [];

			$this->fieldList[$fieldName] = $fieldProps;
		}
	}


	/**
	 * Shortcut for quoting
	 *
	 * @param string $stringToQuote
	 *
	 * @return string
	 */
	protected function quoted(string $stringToQuote)
	{
		return $this->db->quoted($stringToQuote);
	}


	/**
	 * @param array  $parameters
	 * @param string $fieldName
	 *
	 * @return mixed
	 * @throws RestApiException
	 */
	protected function getDateTimeFromParam(array $parameters, string $fieldName)
	{
		try
		{
			$dateTime = new DateTime($parameters[$fieldName] ?? '');
			$dateTimeFormatted = $dateTime->format('Y-m-d H:i:s');
		}
		catch (Exception $exception)
		{
			throw new RestApiException("Datefield {$fieldName} not valid. Should be 'YYYY-MM-DD hh.mm.ss' ");
		}

		return $dateTimeFormatted;
	}

}