<?php

namespace BotWrapper\Chaining\Links;

use BotWrapper\Bot;
use BotWrapper\Chaining\Interfaces\BotInterface;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\Update;

class Middleware implements BotInterface
{
    /** @var Client $bot */
    private $bot;
    /** @var array $middlewares */
    private $middlewares = [];

    public function __construct($middlewares = [])
    {
        $this->bot = Bot::getInstance()->get();
        $this->middlewares = $middlewares;
    }

    public function execute()
    {
        /** @var Client $bot */
        $bot = $this->bot;

        $bot->on(function (Update $update) use (/* @var BotApi $bot */ $bot) {
            /** @var Message $message */
            $message = $update->getMessage();

            //What do if we not has message ?????
            //message var is chat message from user or keyboard
            if ($message) {
                foreach ($this->middlewares as $middleware) {
                    $middleware = new $middleware();
                    $middleware->make($bot, $message);
                }
            }
        }, function () {
            return true;
        });
    }
}