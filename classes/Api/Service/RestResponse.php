<?php

namespace Api\Service;

/**
 * RestResponse
 * 
 * @author Bata Jozsef 
 * 
 */
class RestResponse
{
	protected $httpCode = 200;
	protected $body     = [];
	protected $headers = [];
	protected $responseType = 'json';
	protected $downloadFileName = '';
	protected $downloadFilePath = '';
	protected $downloadFileContent = '';


	/**
	 * @return int
	 */
	public function getHttpCode(): int
	{
		return $this->httpCode;
	}

	/**
	 * @param int $httpCode
	 */
	public function setHttpCode(int $httpCode): void
	{
		$this->httpCode = $httpCode;
	}

	/**
	 * @return array
	 */
	public function getBody(): array
	{
		return $this->body;
	}

	/**
	 * @param array $body
	 */
	public function setBody(array $body): void
	{
		$this->body = $body;
	}
	/**
	 *
	 * @param string $type
	 * @param string $value
	 */
	protected function addHeader(string $type, string $value)
	{
		$this->headers[$type] = $value;
	}

	/**
	 * @return array
	 */
	public function getHeaders(): array
	{
		return $this->headers;
	}

	/**
	 * @param string $key
	 * @param        $value
	 */
	public function addNodeToBody(string $key, $value) {
		$this->body[$key] = $value;
	}
	/**
	 * @param array $keyValuePairs
	 */
	public function addArrayAsNodesToBody(array $keyValuePairs)
	{
		foreach ($keyValuePairs as $key => $value)
		{
			$this->body[$key] = $value;
		}
	}


	public function removeNodeToBody(string $key) {
		unset($this->body[$key]);
	}

	/**
	 * @return string
	 */
	public function getResponseType(): string
	{
		return $this->responseType;
	}

	/**
	 * @param string $responseType
	 */
	public function setResponseType(string $responseType): void
	{
		$this->responseType = $responseType;
	}

	/**
	 * @return string
	 */
	public function getDownloadFileName(): string
	{
		return $this->downloadFileName;
	}

	/**
	 * @param string $downloadFileName
	 */
	public function setDownloadFileName(string $downloadFileName): void
	{
		$this->downloadFileName = $downloadFileName;
	}

	/**
	 * @return string
	 */
	public function getDownloadFilePath(): string
	{
		return $this->downloadFilePath;
	}

	/**
	 * @param string $downloadFilePath
	 */
	public function setDownloadFilePath(string $downloadFilePath): void
	{
		$this->downloadFilePath = $downloadFilePath;
	}

	/**
	 * @return string
	 */
	public function getDownloadFileContent(): string
	{
		return $this->downloadFileContent;
	}

	/**
	 * @param string $downloadFileContent
	 */
	public function setDownloadFileContent(string $downloadFileContent): void
	{
		$this->downloadFileContent = $downloadFileContent;
	}

}