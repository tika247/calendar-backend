<?php

declare(strict_types=1);

namespace server\model;

use server\model\SendRes;

/**
 * authenticate a user and register a token into a session
 */
class AuthenticateUser
{
    use SendRes;

    private $registerUser;
    private $config;
    private $reqData;
    private $authenticateUser;
    private $removeSessionStorage;

    public function __construct($config, $reqData)
    {
        $this->config = $config;
        $this->reqData = $reqData;
    }
    public function init()
    {
        $this->authenticate();
    }
    private function authenticate()
    {
        header('Content-Type: application/json');
        $username = $this->reqData['username'];
        $password = $this->reqData['password'];

        $token = null;
        $userID = null;
        $schedule = null;

        $isUserExsist = false;

        foreach ($this->config['userList'] as $key => $value) {
            if ($value["username"] === $username && $value["password"] === $password) {
                $token = session_id();
                $userID = $value["id"];
                $schedule = $value["schedule"];

                $_SESSION['userID'] = $userID; // assign userID into SESSION

                $isUserExsist = true;
                break;
            }
        }

        if ($isUserExsist) {
            $this->sendRes([$token, $userID, $schedule]);
        } else {
            echo 'userNotExsist';
        }
    }
}
