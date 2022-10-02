<?php

namespace BotWrapper\Chaining;

use BotWrapper\Bot;
use BotWrapper\Chaining\Interfaces\BotInterface;
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

            }

            if (method_exists($message, 'getText')) {
                if(array_key_exists($message->getText(), $this->messages)){
                    $action = $this->messages[$message->getText()];
                    $action = new $action();
                    $action->message($bot, $message);
                }
            }
        }, function () {
            return true;
        });
    }
}