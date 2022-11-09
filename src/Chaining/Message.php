<?php

namespace BotWrapper\Chaining;

use BotWrapper\Chaining\Constants\CommandTypes;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Message as MessageType;

abstract class Message
{
    /** @var string CommandTypes $type */
    public $type = CommandTypes::TYPE_STRING;

    public $signature = '';

    abstract function make(BotApi $bot, MessageType $message);
}