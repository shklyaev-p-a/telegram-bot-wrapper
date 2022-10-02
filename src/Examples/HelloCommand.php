<?php

namespace BotWrapper;

use TelegramBot\Api\Types\Message;

class HelloCommand
{
    public $signature = 'start';

    public function command($bot)
    {
        return function (Message $message) use (/* @var BotApi $bot */ $bot) {
            $chatId = $message->getChat()->getId();
            $bot->sendMessage($chatId, 'hello');
        };
    }
}