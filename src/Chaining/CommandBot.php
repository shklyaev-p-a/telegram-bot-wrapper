<?php

namespace BotWrapper\Chaining;

use BotWrapper\Bot;
use BotWrapper\Chaining\Interfaces\BotInterface;

class CommandBot implements BotInterface
{
    /* @var Client $bot */
    private $bot;
    private $commands;

    public function __construct($commands = [])
    {
        $this->bot = Bot::getInstance()->get();
        $this->commands = $commands;
    }

    public function execute()
    {
        $bot = $this->bot;

        foreach ($this->commands as $command) {
            $command = new $command();
            $bot->command($command->signature, $command->command($bot));
        }
    }
}