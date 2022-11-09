<?php

namespace BotWrapper\Chaining;

use TelegramBot\Api\BotApi;

abstract class Command{

    public $signature = '';

    abstract function command(BotApi $bot);
}