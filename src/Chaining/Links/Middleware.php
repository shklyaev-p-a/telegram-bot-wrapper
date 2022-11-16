<?php

namespace BotWrapper\Chaining\Links;

use BotWrapper\Bot;
use BotWrapper\Chaining\Interfaces\BotInterface;
use BotWrapper\Factories\MatcherFactory;
use TelegramBot\Api\BaseType;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\CallbackQuery;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\Update;
use TelegramBot\Api\BotApi;

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

            if ($message) {
                $this->middlewaresLoop($bot, $message);
            } else {
                $this->callbackRegister($bot);
            }
        }, function () {
            return true;
        });
    }

    private function callbackRegister(Client $bot)
    {
        $bot->callbackQuery(function (CallbackQuery $message) use (/* @var BotApi $bot */ $bot) {
            $this->middlewaresLoop($bot, $message);
        });
    }

    private function middlewaresLoop(Client $bot, BaseType $message)
    {
        foreach ($this->middlewares as $middleware) {
            $middleware = new $middleware();
            $middleware->make($bot, $message);
        }
    }
}