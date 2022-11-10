<?php

namespace BotWrapper\Chaining\Links;

use BotWrapper\Bot;
use BotWrapper\Chaining\Interfaces\BotInterface;
use BotWrapper\Factories\MatcherFactory;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\Update;

class OnBot implements BotInterface
{
    /** @var Client $bot */
    private $bot;
    /** @var array $actions */
    private $actions = [];
    /** @var array $messages */
    private $messages = [];

    public function __construct($actions = [], $messages = [])
    {
        $this->bot = Bot::getInstance()->get();
        $this->actions = $actions;
        $this->messages = $messages;
    }

    public function execute()
    {
        /** @var Client $bot */
        $bot = $this->bot;

        $bot->on(function (Update $update) use (/* @var BotApi $bot */ $bot) {
            /** @var Message $message */
            $message = $update->getMessage();

            if (method_exists($message, 'getText')) {
                $this->actionsProcess($bot, $message);
                $this->messagesProcess($bot, $message);
            }

            if (method_exists($message, 'getFrom')) {
                //idk difference between getForm and getText methods
            }

        }, function () {
            return true;
        });
    }

    protected function actionsProcess(Client $bot, Message $message)
    {
        foreach ($this->actions as $model) {
            $model = new $model();
            if (MatcherFactory::create($model->type)->match($bot->lastAction, $model->signature)) {
                $model->make($bot, $message);
            }
        }
    }

    protected function messagesProcess(Client $bot, Message $message)
    {
        foreach ($this->messages as $model) {
            $model = new $model();
            if (MatcherFactory::create($model->type)->match($message->getText(), $model->signature)) {
                $model->make($bot, $message);
            }
        }
    }
}