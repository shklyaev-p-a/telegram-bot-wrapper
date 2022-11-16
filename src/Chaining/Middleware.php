<?php

namespace BotWrapper\Chaining;

use TelegramBot\Api\BaseType;
use TelegramBot\Api\Client;

abstract class Middleware
{
    abstract function make(Client $bot, BaseType $message = null);
}