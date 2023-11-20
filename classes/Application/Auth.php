<?php

namespace Application;

use Util\SecurityTokenHandler;
use Config\Config;
use DataModel\ModelFactory;
use Exceptions\RestApiException;

/**
 * Auth - handles authentications, login, api-key via token
 * 
 * @author Bata Jozsef
 */
class Auth
{

    private static ?Auth $instance = null;
    private string $userId;
    private string $userName;
    private array $groups;
    private array $rights;
    private string $token;
    private array $userData = [];
    private SecurityTokenHandler $securityTokenHandler;

    /**
     * __construct
     *
     * @return void
     */
    private function __construct()
    {
        $this->securityTokenHandler = new SecurityTokenHandler();
    }

    /**
     * getInstance
     *
     * @return Auth
     */
    public static function getInstance(): Auth
    {
        if (self::$instance == null) {
            self::$instance = new Auth();
        }
        return self::$instance;
    }


    /**
     * getGroups
     *
     * @return array
     */
    public function getGroups(): array
    {
        return $this->groups;
    }

    /**
     * getRights
     *
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }

    /**
     * hasRight
     *
     * @param  string $rightName
     * @return bool
     */
    public function hasRight(string $rightName): bool
    {
        return in_array($rightName, $this->rights);
    }


    /**
     * authenticateWithCredentials
     *
     * @param  string $userName
     * @param  string $userPassword
     * @return string
     */
    public function authenticateWithCredentials(string $loginName, string $userPassword): string
    {
        // $passwordHash = password_hash($value, PASSWORD_BCRYPT );
        $userModel = ModelFactory::getModelInstance('User');
        $users = $userModel->getList(['loginname' => $loginName]);

        if (empty($users)) {
            throw new RestApiException("Authorisation failed", 0, [], 403);            
        }
        if (count($users) !== 1){
            throw new RestApiException("Authorisation failed in a very inconvinient way..", 0, [], 403);            
        }

        $user = $users[0];
        $passwordHash = $user['password'] ?? '';



        if (!password_verify($userPassword, $passwordHash)) {
            throw new RestApiException("Authorisation failed", 0, [], 403);
        }

        $this->userData = [
            "id" => $user['id'],
            "loginname" => $user['loginname'],
            "name" => $user['name'],
            "groups" => [],
            "rights" => [],
            "expires" => date("Y-m-d H:i:s", strtotime("+100 days")),
            "remoteclient" => $this->getClientRemoteAddres()
        ];

        $this->token = $this->securityTokenHandler->getToken($this->userData);


        return $this->token;
    }

    /**
     * authenticateWithToken
     *
     * @param  string $token
     * @return bool
     */
    public function authenticateWithToken(string $token): bool
    {

        $data = $this->securityTokenHandler->checkToken($token);

        if ($data === false) {
            throw new RestApiException("Request needs authorisation", 0, [], 403);
        }


        $this->userData = $data ?? [];

        // checking token exiration time
        $currentTimeStamp = date("Y-m-d H:i:s");
        $expirationTimeStamp = $data['expires'];
        if ($expirationTimeStamp < $currentTimeStamp) {
            throw new RestApiException("Token expired, please get a new one", 0, [], 403);
        }

        // check if token was generated for the same client:            
        $remoteClient = $data['remoteclient'] ?? '??';
        if ($remoteClient !== $this->getClientRemoteAddres()){
            throw new RestApiException("Token invalid, please get a valid token", 0, [], 403);
        }
         

        return true;
    }
    
    /**
     * getClientData
     *
     * @return string
     */
    protected function getClientRemoteAddres():string 
    {
        return $_SERVER['REMOTE_ADDR'] ?? 'unknown_ip';
    }
}
