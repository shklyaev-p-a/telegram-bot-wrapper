<?php

namespace BotWrapper;

use BotWrapper\Chaining\HandlerContainer;
use BotWrapper\Chaining\CommandBot;
use BotWrapper\Chaining\CallbackQueryBot;
use BotWrapper\Chaining\OnBot;

class BotFactory
{
    private $token;
    private $commands;
    private $queries;
    private $actions;
    private $messages;

    public function token(string $token): BotFactory
    {
        $this->token = $token;
        return $this;
    }

    public function commands($commands = []): BotFactory
    {
        $this->commands = $commands;
        return $this;
    }

    public function queries($queries = []): BotFactory
    {
        $this->queries = $queries;
        return $this;
    }

    public function actions($actions = []): BotFactory
    {
        $this->actions = $actions;
        return $this;
    }

    public function messages($messages = []): BotFactory
    {
        $this->messages = $messages;
        return $this;
    }

    public function create(): void
    {
        $bot = \BotWrapper\Bot::getInstance();
        $bot->init($this->token);

        $handler = new HandlerContainer();
        $handler->addHandler(new CommandBot($this->commands));
        $handler->addHandler(new CallbackQueryBot($this->queries));
        $handler->addHandler(new OnBot($this->actions, $this->messages));
        $handler->execute();

        Bot::getInstance()->get()->run();
    }
}