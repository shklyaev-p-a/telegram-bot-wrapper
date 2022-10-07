<?php

namespace BotWrapper\Strategy;

use BotWrapper\Strategy\Interfaces\MatcherInterface;

class ArrayStrategy implements MatcherInterface
{
    public function match($needle, $data): bool
    {
        return in_array($needle, $data);
    }
}