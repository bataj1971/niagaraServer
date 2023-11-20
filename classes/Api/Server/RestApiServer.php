<?php

namespace Api\Server;

use Exceptions\RestApiException;
use Api\Service\RestResponse;
use Util\JsonHandler;

/**
 * Description of Request
 *
 * @author Bata Jozsef
 */
abstract class RestApiServer
{

    use JsonHandler;
    
    const API_SOURCE_PATH = '';

    /**
     * @var string  ( GET, POST,PUT,DELETE,PATCH...)
     */
    protected string $requestMethod = '';

    /**
     * @var array
     */
    protected array $requestParams;

    /**
     * @var int
     */
    protected $startTime;

    /**
     * @var RestResponse
     */
    protected RestResponse $response;

    /**
     * @var string (json, html,...)
     */
    protected string $responseType;

    /**
     * @var array of header lines in key/value structure
     */
    protected array $headers = [];
    
    /**
     * fileHeaders
     *
     * @var array
     */
    protected $fileHeaders = [];

    /**
     * @var array
     */
    protected array $receivedHeaders = [];

    /**
     * @var bool
     */
    protected bool $developmentMode = true; // TODO:  set this to default false

    /**
     * @var array|string[]  list of headers sent with json response
     */
    protected array $jsonHeaders = [];

    /**
     * @var string
     */
    protected string $service;
    
    /**
     * id
     *
     * @var mixed
     */
    protected $id;
    
    /**
     * action
     *
     * @var mixed
     */
    protected string $action;
    
    /**
     * actionId
     *
     * @var mixed
     */
    protected $actionId;
    
    /**
     * apiParameters
     *
     * @var array
     */
    protected $apiParameters = [];

    /**
     * RequestHandler constructor.
     */
    function __construct()
    {
        $this->startTime = -microtime(true);
        $this->jsonHeaders = [
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Allow-Headers' => ' Origin, X-Requested-With, Content-Type, Accept, Authorization',
            'Access-Control-Max-Age' => ' 86400',
                // cache for 1 day
        ];
        $this->response = new RestResponse();
    }

    /**
     * Entrypoint of this class - handling incoming request
     */
    abstract public function run();

    /**
     * setInputParams
     *
     * @return void
     */
    protected function setInputParams()
    {
        // set default responsetype
        $this->responseType = 'json';

        // set requaest method
        $this->requestMethod = $_SERVER['REQUEST_METHOD'] ?? '';

        // set request parameters:
        $this->apiParameters = [];  // restparam4
        $this->apiParameters[0] = $this->requestMethod;
        for ($i = 1; $i < 6; $i++)
        {
            if (isset($_GET['restparam' . $i]))
            {
                $this->apiParameters[$i] = $_GET['restparam' . $i];
                unset($_GET['restparam' . $i]);
            }
        }

        $rawPostContent = file_get_contents("php://input");
        if ($rawPostContent)
        {
            $post = json_decode($rawPostContent, true);
            if (json_last_error() !== JSON_ERROR_NONE)
            {
                $jsonError = json_last_error_msg();
                throw new RestApiException("Json error in post body:{$jsonError}", 403);
            }
        } else
        {
            $post = [];
        }

        $this->requestParams = [];

        $this->requestParams = array_replace_recursive($this->requestParams, $_GET ?? []);
        $this->requestParams = array_replace_recursive($this->requestParams, $_POST ?? []);
        $this->requestParams = array_replace_recursive($this->requestParams, $post);
        $this->receivedHeaders = getallheaders();
    }

    /**
     * Rendering the response content using the format
     */
    protected function sendResponse()
    {
        $time = $this->startTime + microtime(true);

        switch ($this->response->getResponseType())
        {
            case 'json':

                if ($this->developmentMode)
                {
                    $this->response->addNodeToBody(
                            'debug', [
                        'execution_time' => sprintf('%f', $time),
                        'api_development_mode' => "on"]
                    );
                }

                $httpResponseCode = $this->response->getHttpCode();
                http_response_code($httpResponseCode);

                $body = $this->response->getBody();
                $jsonString = json_encode($body, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); // | JSON_FORCE_OBJECT

                $this->sendHeaders($this->jsonHeaders);
                echo $jsonString;
                break;
            case 'file':

                $filePath = $this->response->getDownloadFilePath();
                $fileName = $this->response->getDownloadFileName();
                $this->sendHeaders($this->fileHeaders);
                header("Cache-Control: no-cache, must-revalidate");
                header("Expires: 0");
                header('Content-Disposition: attachment; filename="test_' . date('Ymd-His') . '.zip"');
                header('Content-Length: ' . filesize($filePath));
                readfile($filePath);
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
     * @return array
     * @throws RestApiException
     */
    protected function getEndPoint()
    {
        $endPointList = $this->getJsonFromFile(self::API_SOURCE_PATH . "config/EndPoints.json");
        foreach ($endPointList as $endPointPattern => $props)
        {
            // $requiredParameters = explode("/", $endPointPattern);
            $requiredParameters = preg_split("/[\s\:\/]+/", $endPointPattern);

            $paramCount = 0;
            $match = true;
            $serviceParameters = [];
            foreach ($requiredParameters as $requiredParameter)
            {
                $urlParameter = $this->apiParameters[$paramCount++] ?? '';
                if ($requiredParameter == $urlParameter)
                {
                    continue;
                } elseif ($requiredParameter[0] == "{" and!empty($urlParameter))
                {
                    $parameterName = substr($requiredParameter, 1, -1);
                    $parameterValue = $urlParameter;
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
                    'serviceparameters' => $serviceParameters,
                ];
            }
        }
        // at this point no patterns matched..
        throw new RestApiException("no endpoint pattern match for this url", 404);
    }

}
