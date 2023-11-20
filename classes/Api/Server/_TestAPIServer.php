<?php

namespace Api\Server;

use Util\JsonHandler;
use Util\DB;
use Exceptions\RestApiException;
use Api\Service\RestService;
use Api\Service\RestResponse;

/**
 * Class TestAPIServer
 */
class TestAPIServer extends RestApiServer
{

    use JsonHandler;

    /**
     * entrypoint of the class
     */
    public function run()
    {
        $this->developmentMode = false;
        $time = $this->startTime + microtime(true);

        try
        {
            ob_start();

            if ($this->requestMethod == 'OPTIONS')
            {
                $this->sendResponse();
                return;
            }
            $this->setInputParams();


            $endpoint = $this->getEndPoint();

            $serviceMethodName = $endpoint['endpointproperties']['methodname'] ?? strtolower($this->requestMethod);

            $serviceName = $endpoint['endpointproperties']['service'] ?? '';

            $serviceParameters = array_merge($this->requestParams, $endpoint['serviceparameters'] ?? []);
            // $authenticatedEndPoint = $endpoint['endpointproperties']['authentication'] ?? true;
            $serviceIncludeFile = self::API_SOURCE_PATH . 'classes/Services/' . $serviceName . '.php';

            if (empty($serviceName))
            {
                throw new RestApiException("No endpoint with this name: {$this->service}", 404);
            }

            if (!file_exists($serviceIncludeFile))
            {
                throw new RestApiException("Endpoint not implemented: {$this->service}", 404);
            }



            include($serviceIncludeFile);

            $service = new $serviceName($this->response);

            // $serviceParameters = array_merge($this->requestParams);

            if (!is_subclass_of($service, 'Api\Service\RestService'))
            {
                throw new RestApiException("Class {$serviceName} must be a extended from RestService");
            }

            if (method_exists($service, $serviceMethodName))
            {
                $service->setParams($serviceParameters);
                
               $service->{$serviceMethodName}($serviceParameters);
            } 
            else
            {
                throw new RestApiException(
                                "Service function not defined: {$this->service}::{$serviceMethodName}", 404);
            }
            DB::getInstance()->commitTransaction();
        } catch (RestApiException $e)
        {
            DB::getInstance()->rollbackTransaction();
            
            $this->response->addNodeToBody("success", false);

            $errorList = ['messages' => [$e->getMessage()]];
        

            if ($messages = $e->getData())
            {
                $errorList['messages'] = array_merge($errorList['messages'], $messages);        
            }

            $this->response->addNodeToBody("error", $errorList);
            $httpResponseCode = $e->getHttpResponseCode();

            $this->response->setHttpCode($httpResponseCode);
        } catch (Exception $e)
        {
            $this->response->setHttpCode(500);
            $this->response->addNodeToBody("error", ['messages' => [$e->getMessage()]]);
        }
        $htmlGarbage = ob_get_clean();
        
        $this->sendResponse();
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

        if (!empty($userName) and!empty($passWord))
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
