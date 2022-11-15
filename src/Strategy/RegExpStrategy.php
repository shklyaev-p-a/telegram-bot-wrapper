<?php

namespace BotWrapper\Strategy;

use BotWrapper\Strategy\Interfaces\MatcherInterface;

class RegExpStrategy implements MatcherInterface
{
    public function match($pattern, $data): bool
    {
        return preg_match($pattern, $data);
    }
}