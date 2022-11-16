<?php

namespace BotWrapper\Chaining;

use BotWrapper\Chaining\Constants\CommandTypes;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\Message as MessageType;

abstract class Action
{
    /** @var string CommandTypes $type */
    public $type = CommandTypes::TYPE_STRING;

    /** @var string $signature */
    public $signature = '';

    abstract function make(Client $bot, MessageType $message = null);
}