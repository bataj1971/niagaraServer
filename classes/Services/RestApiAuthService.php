<?php

use Api\Service\RestResponse;
use Api\Service\RestService;
use Application\Auth;

/**
 * Description of RestApiAuthService
 *
 * @author Bata Jozsef 
 */
class RestApiAuthService extends RestService
{
    protected function initService()
    {
    }


    /**
     * login
     *
     * @param  mixed $parameters
     * @return void
     */
    public function login($parameters)
    {
        $loginName = $parameters['loginname'] ?? '';
        $password = $parameters['password'] ?? '';
        $token = Auth::getInstance()->authenticateWithCredentials($loginName, $password);
        $this->response->addNodeToBody("success", true);
        $this->response->addNodeToBody("token", $token);
    }
    /**
     * authorizeService - override disable default auth functions for this service..
     *
     * @return void
     */
    protected function authorizeService()
    {
        // 
    }
}
