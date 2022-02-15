<?php

/**
 * Class RestApiException
 */
class RestApiException extends \Exception
{
	/**
	 * @var array
	 */
	protected $data = [];

	/**
	 * @var string
	 */
	protected $description = '';

	/**
	 * @var int
	 */
	protected $httpResponseCode = 200;

	/**
	 * RestApiException constructor.
	 *
	 * @param array $data
	 * @param int   $httpResponseCode
	 */
	public function __construct(string $message = '', $code = 0, array $data = [], int $httpResponseCode = 200, string $description = '')
	{
		parent::__construct($message, $code, null);
		$this->data             = $data;
		$this->httpResponseCode = $httpResponseCode;
		$this->description      = $description;
	}

	public function getDescription(): string
	{
		return $this->description ?? '';
	}

	/**
	 * @return array
	 */
	public function getData(): array
	{
		return $this->data;
	}

	/**
	 * @return int
	 */
	public function getHttpResponseCode()
	{
		return $this->httpResponseCode;
	}
}