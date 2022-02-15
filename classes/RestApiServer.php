<?php


require_once('classes/Service.php');

/**
 * Description of Request
 *
 * @author Bata Jozsef
 */
abstract class RestApiServer
{
	/**
	 * @var string  ( GET, POST,PUT,DELETE,PATCH...)
	 */
	protected $requestMethod;

	/**
	 * @var array
	 */
	protected $requestParams;

	/**
	 * @var int
	 */
	protected $startTime;

	/**
	 * @var array
	 */
	protected $response = [];

	/**
	 * @var string (json, html,...)
	 */
	protected $responseType;

	/**
	 * @var array of header lines in key/value structure
	 */
	protected $headers = [];

	/**
	 * @var array
	 */
	protected $receivedHeaders = [];

	/**
	 * @var bool
	 */
	protected $developmentMode = true; // TODO:  set this to default false

	/**
	 * @var array|string[]  list of headers sent with json response
	 */
	protected $jsonHeaders = [];

	/**
	 * @var string
	 */
	protected $service;

	protected $id;

	protected $action;

	protected $actionId;

	protected $apiParameters = [];

	/**
	 * RequestHandler constructor.
	 */
	function __construct()
	{
		$this->startTime = -microtime(true);
		$this->setInputParams();
		$this->jsonHeaders = [
			'Content-Type'                     => 'application/json',
			'Access-Control-Allow-Methods'     => 'GET, POST, PUT, DELETE, OPTIONS',
			'Access-Control-Allow-Origin'      => '*',
			'Access-Control-Allow-Credentials' => 'true',
			'Access-Control-Allow-Headers'     => ' Origin, X-Requested-With, Content-Type, Accept, Authorization',
			'Access-Control-Max-Age'           => ' 86400',
			// cache for 1 day
		];
	}

	/**
	 * Entrypoint of this class - handling incoming request
	 */
	abstract public function run();

	/**
	 * Dumps received request data
	 *    Note: only for testing
	 * TODO: remove this
	 */
	protected function createTestResponse()
	{
		$receivedHeaders                             = getallheaders();
		$this->response['debug']['request_method']   = $this->requestMethod;
		$this->response['debug']['received_headers'] = $receivedHeaders;
		$this->response['debug']['request_params']   = $this->requestParams;

		$this->response['debug']['request_path_params'] = [
			'modulename' => $this->service,
			'id'         => $this->id,
			'action'     => $this->action,
			'actionid'   => $this->actionId,
		];
		$this->response['debug']['HTTP_RAW_POST_DATA']  = $GLOBALS['HTTP_RAW_POST_DATA'] ?? '';

		$directoryName = 'Logs';
		$dumpFileName  = $directoryName . '/Request_' . $this->requestMethod . '_' . date('Ymd_His') . '.log';

		if (!file_exists($directoryName))
		{
			mkdir($directoryName, 0775, true);
		}
		$json = json_encode($this->response, JSON_PRETTY_PRINT);
		file_put_contents($dumpFileName, $json);
	}

	protected function setInputParams()
	{
		// set default responsetype
		$this->responseType = 'json';

		// set requaest method
		$this->requestMethod = $_SERVER['REQUEST_METHOD'];

		// set request parameters:
		$this->apiParameters    = [];  // restparam4
		$this->apiParameters[0] = $this->requestMethod;
		for ($i = 1; $i < 6; $i++)
		{
			if (isset($_GET['restparam' . $i]))
			{
				$this->apiParameters[$i] = $_GET['restparam' . $i];
				unset($_GET['restparam' . $i]);
			}
		}

		unset($_GET['entryPoint']);

		$post = json_decode(file_get_contents("php://input"), true) ?? [];

		$this->requestParams = [];

		$this->requestParams   = array_replace_recursive($this->requestParams, $_GET ?? []);
		$this->requestParams   = array_replace_recursive($this->requestParams, $_POST ?? []);
		$this->requestParams   = array_replace_recursive($this->requestParams, $post);
		$this->receivedHeaders = getallheaders();
	}

	/**
	 * Rendering the response content using the format
	 */
	protected function sendResponse()
	{
		$time = $this->startTime + microtime(true);

		switch ($this->responseType)
		{
			case 'json':

				if ($this->developmentMode)
				{
					$this->response['debug']['execution_time']       = sprintf('%f', $time);
					$this->response['debug']['api_development_mode'] = "on";
				}

				$jsonString = json_encode($this->response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); // | JSON_FORCE_OBJECT

				$this->sendHeaders($this->jsonHeaders);
				echo $jsonString;
				break;

			default:
				break;
		}
	}

	/**
	 * As the name sais - sending headers
	 *
	 * @param array $headers
	 */
	private function sendHeaders(array $headers = [])
	{
		$outputHeaders = array_merge($headers, $this->headers);

		foreach ($outputHeaders as $key => $value)
		{
			if ($value !== '')
			{
				$header = $key . ": " . $value;
				header($header);
			}
		}
	}

	/**
	 * Authentication method:   by default basic auth
	 *    - override this if other type of authentication needed:
	 *            in case success:  do nothing
	 *            if failed: set headers and throw exception as below
	 *
	 * @return bool
	 * @throws Exception
	 */
	protected function authenticate(array $authConfig = [])
	{
		if (
			isset($_SERVER['PHP_AUTH_USER'])
			and
			isset($_SERVER['PHP_AUTH_PW'])
			and
			$authConfig['User'] == $_SERVER['PHP_AUTH_USER']
			and
			$authConfig['Password'] == $_SERVER['PHP_AUTH_PW']
		)
		{
			return true;
		}

		if (!empty($_SERVER['REDIRECT_HTTP_AUTHORIZATION']))
		{
			preg_match('/^Basic\s+(.*)$/i', $_SERVER['REDIRECT_HTTP_AUTHORIZATION'], $AUTH_PASS);

			$str = base64_decode($AUTH_PASS[1]);

			[
				$user,
				$password,
			] = explode(':', $str);

			if (
				$authConfig['User'] == $user
				and
				$authConfig['Password'] == $password
			)
			{
				return true;
			}
		}

		header('HTTP/1.1 401 Authorization Required');
		header('WWW-Authenticate: Basic realm="Access denied"');
		throw new Exception("Authentication error");
	}
	/**
	 * @return array|bool
	 */
	protected function getBasicAuthCredentials()
	{
		if (
			isset($_SERVER['PHP_AUTH_USER'])
			and
			isset($_SERVER['PHP_AUTH_PW'])
		)
		{
			$userName = $_SERVER['PHP_AUTH_USER'];
			$passWord = $_SERVER['PHP_AUTH_PW'];
		}
		elseif (!empty($_SERVER['REDIRECT_HTTP_AUTHORIZATION']))
		{
			preg_match('/^Basic\s+(.*)$/i', $_SERVER['REDIRECT_HTTP_AUTHORIZATION'], $AUTH_PASS);

			$str = base64_decode($AUTH_PASS[1]);

			[
				$userName,
				$passWord,
			] = explode(':', $str);
		}

		return [
			'username' => $userName ?? '',
			'password' => $passWord ?? '',
		];
	}
}