<?php

namespace BotWrapper;

use TelegramBot\Api\Client;

class Bot
{
    private $bot = null;

    private static $_instance = null;

    private function __construct()
    {
        //
    }

    protected function __clone()
    {
        //
    }

    static public function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function init(String $token)
    {
        if (!is_null($this->bot)) {
            throw new \Exception('bot init. use reInit method');
        }

        $this->bot = new Client($token);
    }

    public function reInit(String $token)
    {
        $this->bot = new Client($token);
    }

    public function addAdditionalProperty($name, $property)
    {
        if (!property_exists($name)) {
            $this->bot->{$name} = $property;
        } else {
            throw new \Exception('This property already exists');
        }
    }

    public function get()
    {
        if ($this->bot) {
            return $this->bot;
        } else {
            throw new \Exception('Not bot init. Use init method for bot first configuration');
        }
    }
}
