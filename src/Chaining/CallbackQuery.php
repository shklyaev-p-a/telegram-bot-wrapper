<?php

namespace BotWrapper\Chaining;

use BotWrapper\Chaining\Constants\CommandTypes;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Message;

abstract class CallbackQuery
{
    /** @var string CommandTypes $type */
    public $type = CommandTypes::TYPE_STRING;

    public $signature = '';

    abstract function make(BotApi $bot, Message $message);
}