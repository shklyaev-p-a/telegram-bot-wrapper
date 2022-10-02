<?php

namespace BotWrapper\Chaining;

use BotWrapper\Chaining\Interfaces\BotInterface;

class HandlerContainer implements BotInterface
{
    /**
     * @var BotInterface[]
     */

    protected $handlers = [];

    public function execute()
    {
        foreach ($this->handlers as $handler) {
            //Проверку на то что handlers from instance
            $handler->execute();
        }
    }

    public function addHandler(BotInterface $handler)
    {
        $this->handlers[] = $handler;
    }
}