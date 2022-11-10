<?php

namespace BotWrapper\Examples;

use BotWrapper\Chaining\Message;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\Message as MessageType;

class TestMessage extends Message
{
    public $signature = 'test';

    public function make(Client $bot, MessageType $message)
    {
        $bot->sendMessage(
            $message->getFrom()->getId(),
            "test"
        );
    }
}