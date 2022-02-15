<?php

require_once('classes/RestApiServer.php');
require_once('classes/JsonHandler.php');
require_once('classes/RestApiException.php');
require_once('classes/TestService.php');

/**
 * Class TestAPIServer
 */
class TestAPIServer extends RestApiServer
{
	const  API_SOURCE_PATH = '';
	use JsonHandler;

	/**
	 * entrypoint of the class
	 */
	public function run()
	{
		$this->developmentMode = false;
		$time                  = $this->startTime + microtime(true);

		try
		{
			ob_start();



			$endpoint = $this->getEndPoint();

			$serviceMethodName = $endpoint['endpointproperties']['methodname'] ?? strtolower($this->requestMethod);

			$serviceName = $endpoint['endpointproperties']['service'] ?? '';

			$serviceParameters     = array_merge($this->requestParams, $endpoint['serviceparameters'] ?? []);
			$authenticatedEndPoint = $endpoint['endpointproperties']['authentication'] ?? true;
			$serviceIncludeFile    = self::API_SOURCE_PATH . 'services/' . $serviceName . '.php';

			if ($authenticatedEndPoint)
			{
				global $sugar_config;
				$authConfig = $sugar_config['']['apisettings']['SLR']['auth'];
				$this->authenticate($authConfig);
				$this->authenticateViaUserModule();

			}

			if (
				$serviceName
				and
				file_exists($serviceIncludeFile)
			)
			{
				include($serviceIncludeFile);

				$service = new $serviceName();

				// $serviceParameters = array_merge($this->requestParams);

				if (method_exists($service, $serviceMethodName))
				{
					$service->setParams($serviceParameters);
					$this->response = $service->{$serviceMethodName}($serviceParameters);
				}
				else
				{
					throw new RestApiException(
						"No action defined: {$this->service}::{$serviceMethodName}",
						0,
						[],
						404
					);
				}
			}
			else
			{
				throw new RestApiException(
					"No endpoint with this name: {$this->service}",
					0,
					[],
					404
				);
			}
		}
		catch (RestApiException $e)
		{
			$this->response['success']          = false;
			$this->response['error']['message'] = $e->getMessage();
			if ($messages = $e->getData())
			{
				$this->response['error']['messages'] = $e->getData();
			}
			$httpResponseCode = $e->getHttpResponseCode();
			http_response_code($httpResponseCode);
		}
		catch (Exception $e)
		{
			$this->response['error'] = $e->getMessage();
		}
		$htmlGarbage = ob_get_clean();

		$this->sendResponse();
	}

	/**
	 * @return array
	 * @throws RestApiException
	 */
	protected function getEndPoint()
	{
		$endPointList = $this->getJsonFromFile(self::API_SOURCE_PATH . "config/EndPoints.json");
		foreach ($endPointList as $endPointPattern => $props)
		{
			$requiredParameters = explode("/", $endPointPattern);
			$paramCount         = 0;
			$match              = true;
			$serviceParameters  = [];
			foreach ($requiredParameters as $requiredParameter)
			{
				$urlParameter = $this->apiParameters[$paramCount++] ?? '';
				if ($requiredParameter == $urlParameter)
				{
					continue;
				}
				elseif ($requiredParameter[0] == "{" and !empty($urlParameter))
				{
					$parameterName                     = substr($requiredParameter, 1, -1);
					$parameterValue                    = $urlParameter;
					$serviceParameters[$parameterName] = $parameterValue;
					continue;
				}
				// no match - go to the next endpoint pattern
				$match = false;
			}
			if ($match)
			{
				return [
					'endpointproperties' => $props,
					'serviceparameters'  => $serviceParameters,
				];
			}
		}
		// at this point no patterns matched..
		throw new RestApiException("no endpoint pattern match for this url",
			0,
			[],
			404
		);
	}

	/**
	 * @return bool
	 * @throws Exception
	 */
	protected function authenticateViaUserModule()

	{
		$basicAuthCredentials = $this->getBasicAuthCredentials();


		$userName = $basicAuthCredentials['username'] ?? '';
		$passWord = $basicAuthCredentials['password'] ?? '';

		if (!empty($userName) and !empty($passWord))
		{
			ob_start();



			// do authentication here
			$success = true;

			$html = ob_get_clean();
			if ($success)

			{
				return true;
			}
			throw new RestApiException("Authentication error", 0, [], 401);
		}
	}
}