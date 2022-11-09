<?php

namespace BotWrapper\Chaining;

use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Message;

abstract class Middleware
{
    abstract function make(BotApi $bot, Message $message);
}