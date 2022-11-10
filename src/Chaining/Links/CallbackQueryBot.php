<?php

namespace BotWrapper\Chaining\Links;

use BotWrapper\Bot;
use BotWrapper\Chaining\Interfaces\BotInterface;
use TelegramBot\Api\Types\Message;

class CallbackQueryBot implements BotInterface
{
    /** @var Client $bot */
    private $bot;
    /** @var array  $queries*/
    private $queries = [];

    public function __construct($queries = [])
    {
        $this->bot = Bot::getInstance()->get();
        $this->queries = $queries;
    }

    public function execute()
    {
        /* @var Client $bot */
        $bot = $this->bot;

        $bot->callbackQuery(function (Message $message) use (/* @var BotApi $bot */ $bot) {
            foreach ($this->queries as $query) {
                $model = new $query();
                if (MatcherFactory::create($model->type)->match($message->getData(), $model->signature)) {
                    $model->make($bot, $message);
                }
            }
        });
    }
}