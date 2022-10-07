<?php

namespace BotWrapper\Strategy;

use BotWrapper\Strategy\Interfaces\MatcherInterface;

class StringStrategy implements MatcherInterface
{
    public function match($needle, $data): bool
    {
        return $needle === $data;
    }
}