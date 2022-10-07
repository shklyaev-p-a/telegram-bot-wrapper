<?php

namespace BotWrapper\Factories;

use BotWrapper\Bot;
use BotWrapper\Chaining\HandlerContainer;
use BotWrapper\Chaining\Links\CommandBot;
use BotWrapper\Chaining\Links\CallbackQueryBot;
use BotWrapper\Chaining\Links\OnBot;

class BotFactory
{
    public $token;
    public $commands;
    public $queries;
    public $actions;
    public $messages;

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
        $this->botInit($this->token);
        $this->registerContainer();
        $this->botRun();
    }

    public function botInit($token)
    {
        $bot = Bot::getInstance();
        $bot->init($this->token);
    }

    public function registerContainer()
    {
        $handler = new HandlerContainer();
        $handler->addHandler(new CommandBot($this->commands));
        $handler->addHandler(new CallbackQueryBot($this->queries));
        $handler->addHandler(new OnBot($this->actions, $this->messages));
        $handler->execute();
    }

    public function botRun()
    {
        Bot::getInstance()->get()->run();
    }
}