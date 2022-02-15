<?php
require_once('classes/TestService.php');

class RestApiDefaultService extends TestService
{
	public function get(array $params): array
	{
		$result = [
			'success' => true,
			'input'   => $params,
		];

		return $result;
	}

	public function post(array $params): array
	{
		$result = [
			'success' => true,
			'input'   => $params,
		];

		return $result;
	}

	public function put(array $params): array
	{
		$result = [
			'success' => true,
			'input'   => $params,
		];

		return $result;
	}

	public function delete(array $params): array
	{
		$result = [
			'success' => true,
			'input'   => $params,
		];

		return $result;
	}
}