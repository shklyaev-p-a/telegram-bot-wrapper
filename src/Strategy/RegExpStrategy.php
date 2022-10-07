<?php

namespace BotWrapper\Strategy;

use BotWrapper\Strategy\Interfaces\MatcherInterface;

class RegExpStrategy implements MatcherInterface
{
    public function match($needle, $data): bool
    {
        return preg_match($needle, $data);
    }
}