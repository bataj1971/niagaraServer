<?php
namespace Exceptions;
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
	public function __construct(string|array $message = '', int $httpResponseCode = 400,array $data = [])
	{
		parent::__construct($message, $httpResponseCode, null);
		$this->data             = $data;
		$this->httpResponseCode = $httpResponseCode;
		$this->description      = ''; // $description;
	}
	
	/**
	 * getDescription
	 *
	 * @return string
	 */
	public function getDescription(): string
	{
		return $this->description ?? '';
	}

	/**
	 * getData
	 *
	 * @return array
	 */
	public function getData(): array
	{
		return $this->data;
	}
	
	/**
	 * getHttpResponseCode
	 *
	 * @return int
	 */
	public function getHttpResponseCode():int
	{
		return $this->httpResponseCode;
	}
}