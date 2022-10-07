<?php

namespace BotWrapper\Chaining\Links;

use BotWrapper\Bot;
use BotWrapper\Chaining\Interfaces\BotInterface;
use BotWrapper\Factories\MatcherFactory;
use TelegramBot\Api\Types\Update;

class OnBot implements BotInterface
{
    /* @var Client $bot */
    private $bot;
    private $actions = [];
    private $messages = [];

    public function __construct($actions = [], $messages = [])
    {
        $this->bot = Bot::getInstance()->get();
        $this->actions = $actions;
        $this->messages = $messages;
    }

    public function execute()
    {
        $bot = $this->bot;

        $bot->on(function (Update $update) use (/* @var BotApi $bot */ $bot) {
            $message = $update->getMessage();

            if (method_exists($message, 'getFrom')) {
                //Продумать алгоритм lastAction
            }

            if (method_exists($message, 'getText')) {
                foreach ($this->messages as $model) {
                    $model = new $model();
                    //Здесь может быть массив, текст или регулярное выражение
                    if (MatcherFactory::create('string')->match($message->getText(), $model->signature)) {
                        $model->make($bot, $message);
                    }
                }
            }
        }, function () {
            return true;
        });
    }
}