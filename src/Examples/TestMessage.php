<?php

namespace BotWrapper\Examples;

use BotWrapper\Chaining\Message;

class TestMessage extends Message
{
    public $signature = 'test';

    public function make($bot, $message)
    {
        $bot->sendMessage(
            $message->getFrom()->getId(),
            "test"
        );
    }
}