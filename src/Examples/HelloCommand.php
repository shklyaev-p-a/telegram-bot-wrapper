<?php

namespace BotWrapper\Examples;

use BotWrapper\Chaining\Command;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\Message;

class HelloCommand extends Command
{
    public $signature = 'start';

    public function command(Client $bot)
    {
        return function (Message $message) use (/* @var BotApi $bot */ $bot) {
            $chatId = $message->getChat()->getId();
            $bot->sendMessage($chatId, 'hello');
        };
    }
}