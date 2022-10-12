<?php

namespace BotWrapper\Chaining\Links;

use BotWrapper\Bot;
use BotWrapper\Chaining\Interfaces\BotInterface;

class CallbackQueryBot implements BotInterface
{
    /* @var Client $bot */
    private $bot;
    private $queries;

    public function __construct($queries = [])
    {
        $this->bot = Bot::getInstance()->get();
        $this->queries = $queries;
    }

    public function execute()
    {
        /* @var Client $bot */
        $bot = $this->bot;

        $bot->callbackQuery(function ($message) use (/* @var BotApi $bot */ $bot) {
            foreach ($this->queries as $query) {
                $model = new $query();
                if (MatcherFactory::create($model->type)->match($message->getData(), $model->signature)) {
                    $model->make($bot, $message);
                }
            }
        });
    }
}