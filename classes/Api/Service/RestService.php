<?php

namespace Api\Service;

use ApiException;
use Application\Auth;
use Exceptions\RestApiException;

/**
 * 
 */
abstract class RestService extends Service
{

    abstract protected function initService();

    public function get(array $params): void
    {
        throw new ApiException('get method not implemented');
    }

    public function post(array $params): void
    {
        throw new ApiException('post method not implemented');
    }

    public function put(array $params): void
    {
        throw new ApiException('put method not implemented');
    }

    public function delete(array $params): void
    {
        throw new ApiException('delete method not implemented');
    }

    /**
     * @return RestResponse
     */
    public function getResponse(): RestResponse
    {
        return $this->response;
    }

    /**
     *  override this method in a mediator class if auth needed
     */    
    protected function authorizeService()
    {
        // $authorisationTokenHeader = $_SERVER['HTTP_APIKEY'];
        // $authorisationTokenParts = explode(' ', $authorisationTokenHeader);
        // $authorisationToken = $authorisationTokenParts[1] ?? '';
        $authorisationToken = $_SERVER['HTTP_APIKEY'] ?? '';
        Auth::getInstance()->authenticateWithToken($authorisationToken);        
    }

}
