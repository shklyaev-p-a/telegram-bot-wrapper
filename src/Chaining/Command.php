<?php

namespace BotWrapper\Chaining;

use TelegramBot\Api\Client;

abstract class Command
{
    /** @var string $signature */
    public $signature = '';

    abstract function command(Client $bot);
}