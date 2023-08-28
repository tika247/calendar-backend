<?php

declare(strict_types=1);

namespace server\model;

use server\model\DecodeHTMLSpecialChars;
use server\model\SendRes;
use server\model\OverWriteConfig;

/**
 * registerUser
 */
class RegisterUser
{
    use DecodeHTMLSpecialChars;
    use SendRes;
    use OverWriteConfig;

    private $config;
    private $reqData;
    private $configPath;
    private $registerUser;
    private $authenticateUser;
    private $removeSessionStorage;

    public function __construct($config, $reqData, $configPath)
    {
        $this->config = $config;
        $this->reqData = $reqData;
        $this->configPath = $configPath;
    }
    public function init()
    {
        $this->registerUser();
    }
    private function registerUser()
    {
        header('Content-Type: application/json');
        $username = $this->reqData['username'];
        $password = $this->reqData['password'];

        $isUserDuplication = false;

        foreach ($this->config['userList'] as $key => $value) {
            if ($value["username"] === $username && $value["password"] === $password) {
                $isUserDuplication = true;
                break;
            }
        }

        if (!$isUserDuplication) {
            $token = session_id();

            $newUser = new \stdClass();
            $newUser->id = uniqid();
            $newUser->username = $username;
            $newUser->password = $password;
            $newUser->schedule = [];

            $_SESSION['userID'] = $newUser->id; // assign userID into SESSION

            $this->updateConfig($newUser); // update config

            $this->sendRes([$token, $newUser->id, $newUser->schedule]);
        } else {
            echo 'userDuplication';
        }
    }
    private function updateConfig($newUser)
    {
        array_push($this->config['userList'], $newUser);
        $this->config = $this->decodeHTMLSpecialChars($this->config);
        $this->overWriteConfig($this->configPath, $this->config);
    }
}
