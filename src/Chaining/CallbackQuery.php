<?php

namespace BotWrapper\Chaining;

use BotWrapper\Chaining\Constants\CommandTypes;

abstract class CallbackQuery
{
    /** @var string CommandTypes $type */
    public $type = CommandTypes::TYPE_STRING;

    public $signature = '';

    abstract function make($bot, $message);
}