<?php

namespace BotWrapper\Chaining;

use BotWrapper\Chaining\Constants\CommandTypes;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\Message;

abstract class CallbackQuery
{
    /** @var string CommandTypes $type */
    public $type = CommandTypes::TYPE_STRING;

    /** @var string $signature */
    public $signature = '';

    abstract function make(Client $bot, Message $message);
}