<?php

namespace BotWrapper\Examples;

use BotWrapper\Chaining\Command;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\BotApi;

class GoodbyeCommand extends Command
{
    public $signature = 'exit';

    public function command($bot)
    {
        return function (Message $message) use (/* @var BotApi $bot */ $bot) {
            $chatId = $message->getChat()->getId();
            $bot->sendMessage($chatId, 'goodbye');
        };
    }
}