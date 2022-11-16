<?php

namespace BotWrapper\Chaining\Links;

use BotWrapper\Bot;
use BotWrapper\Chaining\Interfaces\BotInterface;
use BotWrapper\Factories\MatcherFactory;
use TelegramBot\Api\BaseType;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\CallbackQuery;

class CallbackQueryBot implements BotInterface
{
    /** @var Client $bot */
    private $bot;
    /** @var array $queries */
    private $queries = [];
    /** @var array $middlewares */
    private $middlewares = [];

    public function __construct($queries = [], $middlewares = [])
    {
        $this->bot = Bot::getInstance()->get();
        $this->queries = $queries;
        $this->middlewares = $middlewares;
    }

    public function execute()
    {
        /* @var Client $bot */
        $bot = $this->bot;

        $bot->callbackQuery(function (CallbackQuery $message) use (/* @var BotApi $bot */ $bot) {
            $this->middlewaresLoop($bot, $message);

            foreach ($this->queries as $query) {
                $model = new $query();
                if (MatcherFactory::create($model->type)->match($model->signature, $message->getData())) {
                    $model->make($bot, $message);
                }
            }
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