<?php

namespace BotWrapper;

use BotWrapper\Exceptions\BotAlreadyInitException;
use BotWrapper\Exceptions\EmptyBotException;
use TelegramBot\Api\Client;

/**
 * Class Bot
 * @package BotWrapper
 */
class Bot
{
    /** @var Client $bot | null */
    private $bot = null;

    /** @var Bot | null */
    private static $_instance = null;

    /**
     * Bot constructor.
     */
    private function __construct()
    {
    }

    /**
     *
     */
    protected function __clone()
    {
    }

    /**
     * @return Bot
     */
    static public function getInstance(): Bot
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * @param string $token
     * @param array $data
     * @throws BotAlreadyInitException
     */
    public function init(string $token, array $data = []): void
    {
        if (!is_null($this->bot)) {
            throw new BotAlreadyInitException();
        }

        $this->setBot($token);
        $this->setDefaultData($data);
    }

    /**
     * @param array $data
     * set default lastAction and can set other meta data
     */
    public function setDefaultData(array $data = [])
    {
        $this->bot->lastAction = '';
        foreach ($data as $dataName => $dataValue) {
            $this->bot->{$dataName} = $dataValue;
        }
    }

    /**
     * @param string $token
     */
    public function override(string $token): void
    {
        $this->setBot($token);
    }

    /**
     * @param $name
     * @param $property
     * @throws \Exception
     */
    public function addAdditionalProperty($name, $property): void
    {
        if (property_exists($this->bot, $name)) {
            throw new \Exception('This property already exists');
        }

        $this->getBot()->{$name} = $property;
    }

    /**
     * @return Client
     * @throws \Exception
     */
    public function get(): Client
    {
        if (!$this->getBot()) {
            throw new EmptyBotException();
        }

        return $this->getBot();
    }

    /**
     * @param string $token
     * @return Client
     */
    public function createClient(string $token): Client
    {
        return new Client($token);
    }

    /**
     * @param string $token
     */
    private function setBot(string $token): void
    {
        $this->bot = $this->createClient($token);
    }

    /**
     * @return Client|null
     */
    private function getBot()
    {
        return $this->bot;
    }
}
