<?php

namespace BotWrapper\Chaining;

use TelegramBot\Api\Client;
use TelegramBot\Api\Types\Message;

abstract class Middleware
{
    abstract function make(Client $bot, Message $message);
}