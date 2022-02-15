<?php

/**
 * Class RequestLogger
 */
class RequestLogger
{
	protected $response = [];

	protected $requestParams;

	protected $requestMethod;

	public function run()
	{
		$this->requestMethod = $_SERVER['REQUEST_METHOD'];
		$input               = file_get_contents("php://input") ?? '';
		$input_json          = json_decode($input, true) ?? [];

		$this->requestParams = [];

		$this->requestParams['GET']        = $_GET ?? [];
		$this->requestParams['POST']       = $_POST ?? [];
		$this->requestParams['INPUT']      = $input;
		$this->requestParams['INPUT_JSON'] = $input_json;

		$receivedHeaders                             = getallheaders();
		$this->response['debug']['request_method']   = $this->requestMethod;
		$this->response['debug']['received_headers'] = $receivedHeaders;
		$this->response['debug']['request_params']   = $this->requestParams;

		$directoryName = 'logs';
		$dumpFileName  = $directoryName . '/request_' . $this->requestMethod . '_' . date('Ymd_His') . '.log';

		if (!file_exists($directoryName))
		{
			mkdir($directoryName, 0775, true);
		}
		$json = json_encode($this->response, JSON_PRETTY_PRINT);
		file_put_contents($dumpFileName, $json);
	}
}



