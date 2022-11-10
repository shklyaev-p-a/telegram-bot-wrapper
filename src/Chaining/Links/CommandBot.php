<?php

namespace BotWrapper\Chaining\Links;

use BotWrapper\Bot;
use BotWrapper\Chaining\Interfaces\BotInterface;
use TelegramBot\Api\Client;

class CommandBot implements BotInterface
{
    /** @var Client $bot */
    private $bot;
    /** @var array $commands */
    private $commands;

    public function __construct($commands = [])
    {
        $this->bot = Bot::getInstance()->get();
        $this->commands = $commands;
    }

    public function execute()
    {
        /** @var Clientt $bot */
        $bot = $this->bot;

        foreach ($this->commands as $command){
            $command = new $command();
            $bot->command($command->signature, $command->command($bot));
        }
    }
}