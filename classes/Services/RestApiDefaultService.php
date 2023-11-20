<?php

use Api\Service\Service;
use Api\Service\RestResponse;

class RestApiDefaultService extends Service
{
	public function get(array $params): void
	{
		$result = [
			'success' => true,
			'input'   => $params,
		];

		$this->response->addArrayAsNodesToBody($result) ;
	}

	protected function initService()
	{		
	}

	public function post(array $params): void
	{
		$result = [
			'success' => true,
			'input'   => $params,
		];

		$this->response->addArrayAsNodesToBody($result);
	}

	public function put(array $params): void
	{
		$result = [
			'success' => true,
			'input'   => $params,
		];

		$this->response->addArrayAsNodesToBody($result);
	}

	public function delete(array $params): void
	{
		$result = [
			'success' => true,
			'input'   => $params,
		];

		$this->response->addArrayAsNodesToBody($result);
	}
}