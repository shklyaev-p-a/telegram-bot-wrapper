<?php

namespace BotWrapper\Chaining\Links;

use BotWrapper\Bot;
use BotWrapper\Chaining\Interfaces\BotInterface;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\Update;

class Middleware implements BotInterface
{
    /* @var Client $bot */
    private $bot;
    private $middlewares = [];

    public function __construct($middlewares = [])
    {
        $this->bot = Bot::getInstance()->get();
        $this->middlewares = $middlewares;
    }

    public function execute()
    {
        $bot = $this->bot;

        $bot->on(function (Update $update) use (/* @var BotApi $bot */ $bot) {
            /** @var Message $message */
            $message = $update->getMessage();

            foreach ($this->middlewares as $middleware) {
                $middleware = new $middleware();
                $middleware->make($bot, $message);
            }
        }, function () {
            return true;
        });
    }
}